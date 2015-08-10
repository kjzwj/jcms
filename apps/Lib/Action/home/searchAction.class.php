<?php
/**
 * 内容控制器
 */
class searchAction extends frontendAction {
	
		public function _initialize() {
			parent::_initialize();
			$this->_mod = D('content');
			$this->cate_mod = D('category');
		}


		/* 栏目页面
		* @ $catid 分类ID 必须的参数
		*/
		function index()
		{	
			//检查栏目
			$catid = $this->_get('catid','intval');
			!$catid && $this->error(L('category_null'));

			// 关键字
			$keyword = $this->_get('keyword');
			!$keyword && $this->error(L('keyword_null'));


			$map=array();
			$map['catid'] = $catid;
			$map['keyword'] = $keyword;
			$data = D('content')->get_list($map);

			$this->assign('keyword',$keyword);
			$this->assign($data);	
			$this->theme('search');
		}
		
		
}