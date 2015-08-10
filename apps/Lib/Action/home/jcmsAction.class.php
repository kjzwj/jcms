<?php
class jcmsAction extends frontendAction {
	
	public function _initialize() {
		parent::_initialize();
	}
	
    public function index(){
        $this->release();
    }


    public function release(){
        $list = array(
            '20150801' => array(
                'title' => 'J-cms beta v1.2 Release 20150801',
                'desc'  => '1. 增加会员功能<br>2. 增加社交帐号接入（QQ登录、微博登录、微信登录因条件限制暂未开通）<br>3. 修复后台某些情况删除内容时不能删除相关字段问题<br>4. 修复URL错误问题<br>5. 美化提示页面与404页面',
                'url'   => C('sys_siteurl').'/Release/J-cms_beta_v1.2.zip',
            ),
            '20150523' => array(
                'title' => 'J-cms beta v1.1 Release 20150523',
                'desc'  => '1. 增加广告标签增加广告标签 <code>&lt;adset pos="posname" item="ad"&gt;&lt;/adset&gt;</code><br> 2. 增加搜索功能 search.html?catid=1&keyword=title<br> 3. 优化表单功能<br>',
                'url'   => C('sys_siteurl').'/Release/J-cms_beta_v1.1.zip',
            ),
            '20150516' => array(
                'title' => 'J-cms beta v1.0 Release 20150516',
                'desc'  => '2015年5月16号，J-cms 测试版 v1.0 发布，欢迎大家使用！',
                'url'   => C('sys_siteurl').'/Release/J-cms_beta_v1.0.zip',
            ),
        );

        
    	$seo['title'] = 'J-cms下载页面';
        $seo = $this->_seo($seo);
        $this->assign('list',$list);
        $this->theme('release','system');
    }

}