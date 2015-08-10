<?php
/**
 * 内容控制器
 */
class contentAction extends frontendAction {
	
		public function _initialize() {
			parent::_initialize();
			$this->_mod = D('content');
			$this->cate_mod = D('category');
		}


		/* 栏目页面
		* @ $cid 分类ID 必须的参数
		*/
		function index()
		{	

			//检查栏目
			$cid = $this->_get('cid','intval');
			$alias = $this->_get('name','trim');

			if(!$cid && !$alias)
				$this->error(L('category_null'));

			if($cid){
				$cate = $this->cate_mod->get_info($cid);
			}else if($alias){
				$cate = $this->cate_mod->where(array('alias'=>$alias))->find();
			}
			!$cate && $this->error(L('category_null'));

			//决定栏目类型；1=单页面，2=外链接；0=普通分类
			switch(intval($cate['type']))
			{
				 case 1:	//单页面使用封面模板
				 	$template=$cate['template_index'];
				 	break;
				 case 2:	//外链接直接跳转
				 	redirect($cate['alias']);
				 	exit;
				 	break;
				 default:	//默认为列表页模板
				 	$template=$cate['template_list'];
			}
			// 封面模板
			if($cate['type']==0){
				$scateNum = $this->cate_mod->where(array('pid'=>$cid))->count(id);
				if( $scateNum>0 )
					$template=$cate['template_index'];
			}

			$spid = explode('|', $cate['spid']);
			$topid = $spid[0];
			if($topid==0) $topid=$cate['id'];
			$pid = $cate['pid'];
			if($pid==0) $pid=$cate['id'];

			$seo['title'] = $cate['seotitle']?$cate['seotitle']:$cate['name'];
			$seo['keys'] = $cate['seokeywords'];
			$seo['desc'] = $cate['seodescription'];
			$this->_seo($seo);

			$this->assign('current',$topid);
			$this->assign('topid',$topid);
			$this->assign('pid',$pid);
			$this->assign('category',$cate);
			$this->assign('catid',$cid);
			$this->theme($template);
		}


		/* 文章阅读
		* @ $id 文章ID
		*/
		function view()
		{
			$id = $this->_get('id','intval');

			$info = $this->_mod->get_info($id,true);
			if(!$info)
			{
				$this->_empty();
				exit;
			}

			$cate = $this->cate_mod->get_info($info['cat_id']);

			$spid = explode('|', $cate['spid']);
			$topid = $spid[0];
			if($topid==0) $topid=$cate['id'];
			$pid = $cate['pid'];
			if($pid==0) $pid=$cate['id'];

			$seo['title'] = $info['seo_title']?$info['seo_title']:$info['title'];
			$seo['keys'] = $info['seo_key'];
			$seo['desc'] = $info['seo_desc'];
			$this->_seo($seo);

			$this->assign('catid',$cate['id']);
			$this->assign('topid',$topid);
			$this->assign('current',$topid);
			$this->assign('pid',$pid);
			$this->assign('info',$info);
			$this->theme($cate['template_show']);
		}
		
		
		
		
}