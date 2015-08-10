<?php
class indexAction extends frontendAction {
	
	public function _initialize() {
		parent::_initialize();
	}
	
    public function index(){
        $this->assign('current','home');
        $this->theme('index');
    }


    // ajax登录状态
    public function ajax_login(){
        $return = false;
        if(user_login()){
            $return = '<span>您好，'.$_SESSION['user_login']['uname'].'</span><b>|</b><a href="'.U('user/logout').'">登出</a>';
        }
        echo $return;
    }

}