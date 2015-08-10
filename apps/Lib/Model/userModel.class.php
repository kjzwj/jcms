<?php
class userModel extends Model {

	function check_user( $value, $field='email' ){

    	$v= 1;

    	$map = array();
    	$map[$field] = $value;
    	$res = $this->where($map)->count('id');
    	// echo $this->getLastSql();
    	if( !$res )
    		$v = 0;

    	return $v;
    }
    

    // 添加用户
    function reg( $data ){

        if(!$data['email']){
            return array('status'=>0,'msg'=>L('email_require'));
        }
        if(!$data['password']){
            return array('status'=>0,'msg'=>L('password_require'));
        }

        if( $this->check_user($data['email']) > 0 )
            return array('status'=>0,'msg'=>'用户已经存在，登录邮箱不能重复。');

        // 用于写入的数组
        $indata = array();
        $indata = $data;
        $indata['regtime'] = time();
        $indata['regip'] = get_client_ip();
        $indata['status']  = 1;
        $indata['salt'] = user_salt();
        $indata['password'] = user_md5($data['password'],$indata['salt']);

        $insertId = $this->add($indata);
        // 写入记录
        if( $insertId ){
            return array('status'=>1,'msg'=>'注册成功！','userid'=>$insertId);
        }

        return array('status'=>0,'msg'=>'注册失败，请重试。');

    }

    /**
     * 登录指定用户
     * @param  integer $uid 用户ID
     * @return boolean      ture-登录成功，false-登录失败
     */
    public function login($uid,$email=null,$password=null){
        /* 检测是否在当前应用注册 */
        $user = $this->field(true)->find($uid);
        if(!$user || 1 != $user['status']) {
            return '用户不存在或已被禁用！'; //应用级别禁用
            exit;
        }

        /* 登录用户 */
        $this->autoLogin($user);
        return true;
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        session('user_login', null);
        session('user_login_sign', null);
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'id'             => $user['id'],
            'login'           => array('exp', '`login`+1'),
            'lasttime' => NOW_TIME,
            'lastip'   => get_client_ip(),
        );
        $this->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'userid'             => $user['id'],
            'uname'        => $user['uname']?$user['uname']:$user['email'],
            'last_login_time' => $user['lasttime'],
        );

        session('user_login', $auth);
        session('user_login_sign', data_auth_sign($auth));

    }

}