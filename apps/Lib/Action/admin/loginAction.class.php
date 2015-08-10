<?php
class loginAction extends Action {

    function index()
    {
        if(admin_login()){
            $this->redirect('index/index');
        }else{
            $this->display();
        }
    }


    /* 登入 */
    public function signin(){
		
		if(IS_POST){
    		$username = $this->_post('username');
    		$password = $this->_post('password');
    		$verify = $this->_post('verify');

    		if(!$username || !$password || !$verify)
    			$this->error('参数错误！');

    		/* 检测验证码 TODO: */
            if (!Verify::check(@$verify)) {
				$this->error('验证码输入错误！');
			}

			$db = M('admins');
			$map['username'] = $username;
			$map['status'] = 1;
			$user = $db->where($map)->find();
			if(!$user){
				$this->error('帐号不存在或被禁用');
			}
			if($user['password'] != user_md5($password.$user['salt'])){
				$this->error('密码错误');
			}

			$data = array(
				'id'              => $user['id'],
				'login'           => array('exp', '`login`+1'),
				'last_login_time' => NOW_TIME,
				'last_login_ip'   => get_client_ip(),
			);
			$db->save($data);

			/* 记录登录SESSION和COOKIES */
			$auth = array(
				'uid'             => $user['id'],
				'username'        => $user['username'],
				'last_login_time' => $data['last_login_time'],
			);
			session('admins', $auth);
        	session('admins_sign', data_auth_sign($auth));
			$this->success('登录成功，正在进入...', U('index/index'));
    	}else{
    		$this->redirect('index');
    		exit;
    	}

    }


    /* 退出登录 */
    public function logout(){
        if(admin_login()){
			session('admins', null);
			session('admins_sign', null);
            session('[destroy]');
            $this->success('退出成功！','/');
        } else {
            $this->redirect('index');
        }
    }

    Public function verify()
    {
	    import('ORG.Verify');
	    Verify::entry();
 	}
			

}