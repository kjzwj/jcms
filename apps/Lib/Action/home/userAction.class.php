<?php
class userAction extends frontendAction {
	
	public function _initialize() {
		parent::_initialize();
        $this->_mod = D('user');
        $this->_userid = user_login();
        if($this->_userid){
            $userinfo = $this->_mod->find($this->_userid);
            $this->assign('userid',$this->_userid);
            $this->assign('userinfo',$userinfo);
        }
        $this->assign('current','user');
        $seo['title'] = '会员中心';
        $this->_seo($seo);
	}

    public function index(){
        $this->theme('index','user');
    }


    // 个人信息
    public function profile(){
        if(IS_POST){
            $post = $this->_post('info');
            $data = $this->_mod->create($post);
            // 修改密码
            if( trim($post['password']) ){
                $data['salt'] = user_salt();
                $data['password'] = user_md5($data['password'],$data['salt']);
            }else{
                unset($data['password']);
            }
            $data['id'] = $this->_userid;
            $this->_mod->where(array('id'=>$this->_userid))->save($data);
            $this->success(L('operation_success'));
        }else{
            $this->assign('active','profile');
            $this->theme('profile','user');
        }
    }


    // 修改头像
    public function avatar(){
        $this->assign('active','avatar');
        $this->theme('avatar','user');
    }



    // 帐号绑定
    function bind(){
        $this->assign('active','bind');
        $this->theme('bind','user');
    }


    // 注册页面
    public function register(){
        if(IS_POST){
            $post['email'] = $this->_post('email');
            $post['password'] = $this->_post('password');
            $post['repassword'] = $this->_post('repassword');
            $post['uname'] = $this->_post('uname');
            $verify = $this->_post('verify');

            /* 检测验证码 TODO: */
            if (!Verify::check(@$verify)) {
                $this->error('验证码输入错误！');
            }

            $data = $this->_mod->create($post);
            if(!$data['email'])
                $this->error('请输入注册邮箱');
            if(!$data['password'] || ($data['password'] !== $post['repassword']))
                $this->error('您两次输入的密码不一致。');

            $res = $this->_mod->reg($data);
            if($res['status']==1)
                $this->success('注册成功，请登录！',U('login'));
            else
                $this->error($res['msg']);
        }else{
            if($this->_userid){
                $this->redirect('/');
            }else{
                $seo['title'] = '会员注册';
                $seo['desc'] = '免费注册成为'.C('sys_sitename').'的会员';
                $this->_seo($seo);
                $this->theme('register','user');
            }
        }
    }


    // 登录页面
    public function login(){

        if(IS_POST){
            $email = $this->_post('email');
            $password = $this->_post('password');
            $verify = $this->_post('verify');

            /* 检测验证码 TODO: */
            if (!Verify::check(@$verify)) {
                $this->error('验证码输入错误！');
            }

            $map['email'] = trim($email);
            $map['status'] = 1;

            $this->_mod = $this->_mod;
            $user = $this->_mod->where($map)->find();
            if(!$user){
                 $this->error('用户不存在或已被禁用！'); //应用级别禁用
                 exit;
            }

            if(user_md5($password,$user['salt']) !== $user['password'])
            {
                $this->error('密码不正确');
            }
        
            /* 登录用户 */
            if($this->_mod->login($user['id'],$email,$password)){ //登录用户
                //TODO:跳转到登录前页面
                $this->success('登录成功！', session('rebackurl'));
            } else {
                $this->error($this->_mod->getError());
            }

        } else {
            if($this->_userid){
                $this->redirect('index');
            }else{
                // 登录后返回登录前页面
                $reback = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'/';
                if(stripos($reback, 'login') || stripos($reback, 'register') || stripos($reback, 'logout')){
                    $reback = U('index');
                }
                session('rebackurl',$reback);

                $seo['title'] = '会员登录';
                $this->_seo($seo);
                $this->theme('login','user');
            }
        }
    }


    // 登出
    public function logout(){
        if($this->_userid){
            $this->_mod->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect(U('login'));
        }
    }


    // 验证码
    public function verify()
    {
        import('ORG.Verify');
        Verify::entry();
    }


}