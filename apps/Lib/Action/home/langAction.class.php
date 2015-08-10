<?php
/**
 * 切换页面语言
 * 后台也用到，请勿删除
 */
class langAction extends frontendAction{
	
		public function _initialize() {
				parent::_initialize();
				$this->_mod = D('lang');
		}	
	
    public function index() {
			$code = $this->_request('code','trim');
			$gourl = $this->_request('gourl','trim',$_SERVER['HTTP_REFERER']);
			$cfg_lang = explode(',',C('LANG_LIST'));
			if($this->_mod->checklang($code) && in_array($code,$cfg_lang))
			{
				cookie('jcms_lang',$code,3600);
				if($gourl){
					header("Location: $gourl");
					exit;
				}
			}
			echo "<script>history.go(-1);</script>";
			exit;
    }
}