<?php
/*
* 社交登录
* 微信登录需要开发者认证 http://open.weixin.qq.com
*/
class oauthAction extends frontendAction {
	
	public function _initialize() {
		parent::_initialize();
        $this->assign('current','user');
        $this->user_model = D('user');
	}
	

    // QQ登录
    public function qq(){
        Vendor('Oauth.QC#class');
        $qc = new \QC();
        $qc->qq_login();
    }


    // QQ登录回调处理
    public function qqcallback(){

        Vendor('Oauth.QC#class');
        $qc = new \QC();
        $token = $qc->qq_callback();
        $openid = $qc->get_openid();

        if(!$token || !$openid){
            $this->error('操作失败');
        }

        // 重新实例化 QC类
        $qc = new \QC($token,$openid);
        $uinfo = $qc->get_user_info();


        $this->user_model = D('user');
        $user = $this->user_model->field('id,email,password')->where(array('qq_token'=>$token,'qq_openid'=>$openid))->find();
        // echo $this->user_model->getLastSql();

        if( $user['id']>0 ){
            // 登录用户
            if($this->user_model->login($user['id'],$user['email'],$user['password'])){
                //TODO:跳转到登录前页面
                $this->success('登录成功！', session('rebackurl'));
            } else {
                $this->error($model->getError());
            }
        }else{
            session('avatar',$uinfo['figureurl_qq_2']);
            session('openid',$openid);
            session('token',$token);
            session('uname',$uinfo['nickname']);
            session('oatype','qq_');
            //print_r($uinfo);
            $this->redirect('join');
        }

    }


    // 新浪微博登录
    public function weibo(){
        Vendor('Weibo.saetv2#ex#class');
        $o = new \SaeTOAuthV2( C('weibo.wb_akey') , C('weibo.wb_skey') );
        $code_url = $o->getAuthorizeURL( C('weibo.wb_callback_url') );
        header('Location: '.$code_url);
        exit();
    }

    // 微博登录回调处理
    public function wbcallback(){
        Vendor('Weibo.saetv2#ex#class');
        $o = new \SaeTOAuthV2( C('weibo.wb_akey') , C('weibo.wb_skey') );

        if (isset($_REQUEST['code'])) {
            $keys = array();
            $keys['code'] = $this->_request('code');;
            $keys['redirect_uri'] = C('weibo.wb_callback_url');
            try {
                $token = $o->getAccessToken( 'code', $keys ) ;
            } catch (OAuthException $e) {
            }
        }

        if ($token) {
            // 获取用户信息
            $c = new SaeTClientV2( C('weibo.wb_akey') , C('weibo.wb_skey') , $token['access_token'] );
            // $ms  = $c->home_timeline(); // done
            $uid_get = $c->get_uid();
            $uid = $uid_get['uid'];
            $uinfo = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

            // 查询是否已经绑定
            $this->user_model = D('user');
            $user = $this->user_model->field('id,email,password')->where(array('wb_token'=>$token['access_token'],'wb_openid'=>$uid))->find();
            // echo $this->user_model->getLastSql();

            if( $user['id']>0 ){
                // 登录用户
                if($this->user_model->login($user['id'],$user['email'],$user['password'])){
                    //TODO:跳转到登录前页面
                    $this->success('登录成功！', session('rebackurl'));
                } else {
                    $this->error($model->getError());
                }
            }else{
                session('avatar',$uinfo['avatar_hd']);
                session('openid',$uinfo['id']);
                session('token',$token['access_token']);
                session('uname',$uinfo['screen_name']);
                session('oatype','wb_');
                //print_r($uinfo);
                $this->redirect('join');
            }

        } else {
            $this->error('授权失败。');
        }
    }


    // 微信登录
    public function weixin(){
        header("Content-type: text/html; charset=utf-8");
        echo '<title>微信登录</title>';
        echo '<p>微信功能暂未开通</p>';
        echo '<p>如需要此功能，请<a href="http://www.yundes.com/#contact" target="_blank">联系我们</a>定制开发。</p>';
        exit;
    }


    // 关联本站帐号
    public function join(){

        // 开放接口个人资料
        $openinfo['oatype'] = $oatype = session('oatype');
        $openinfo['avatar'] = session('avatar');
        $openinfo['uname'] = session('uname');
        $openinfo[$oatype.'openid'] = session('openid');
        $openinfo[$oatype.'token'] = session('token');
        $openinfo[$oatype.'name'] = session('uname');

        foreach ($openinfo as $key => $val) {
            if($val=='' || empty($val)){
                $this->error('非法操作');
            }
        }

        // 已经登录直接绑定
        if(user_login()){
            $this->user_model->where(array('id'=>user_login()))->save($openinfo);
            $this->success('绑定成功！',U('user/bind'));
            exit;
        }

        if(IS_POST){
            $post['email'] = $this->_post('email');
            $post['password'] = $this->_post('password');
            $post['repassword'] = $this->_post('repassword');

            $data = $this->user_model->create($post);
            if(!$data['email'])
                $this->error('请输入注册邮箱');
            if(!$data['password'] || ($data['password'] !== $post['repassword']))
                $this->error('您两次输入的密码不一致。');
            

            // 绑定，否则注册
            if( $this->user_model->check_user($data['email']) > 0 ){

                $map = array('email'=>$data['email']);
                $hasuser = $this->user_model->field('id,email,password,salt')->where($map)->find();
                // 检测密码是否正确
                if($hasuser['password'] == user_md5($data['password'],$hasuser['salt'])){
                    $this->user_model->where($map)->save($openinfo);
                    if($this->user_model->login($hasuser['id'])){
                        //TODO:跳转到登录前页面
                        $this->success('登录成功！', U('/'));
                    } else {
                        $this->error($model->getError());
                    }
                }else{
                    $this->error('此邮箱已经注册，输入正确的密码绑定社交帐号');
                }

                
            }else{
                $data = array_merge($data,$openinfo);
                $res = $this->user_model->reg($data);
                if($res['status']==1){
                    if($this->user_model->login($res['userid'])){
                        //TODO:跳转到登录前页面
                        $this->success('登录成功！', U('/'));
                    } else {
                        $this->error($model->getError());
                    }
                }else{
                    $this->error($res['msg']);
                }
            }
        }else{
            $this->theme('join','user');
        }
    }


}