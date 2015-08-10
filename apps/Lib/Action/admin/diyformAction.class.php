<?php
class diyformAction extends backendAction {

		public function _initialize() {
			parent::_initialize();
			$this->_list_mod = M('diyform_list');
			$this->_mflist = D('mflist');
			$this->_mod = D('diyform');
		}
		
		
		function _after_update($diyid)
		{
			//清除缓存
			F('diyinfo_'.$diyid,NULL);
		}
		
		
		/*
		*	表单信息列表
		*	@id 表单的ID/模型ID
		*/
		function info()
		{
				$diyid = $this->_request("id", 'intval');
				!$diyid && $this->error(L('_PARAM_ERROR_'));
				
				$diyform_title = $this->_mod->get_diyform($diyid,'title');
				$this->assign('diyform_title',$diyform_title);
				
				//取出附加字段
				$fields = D('model_fields')->get_fields($diyid,array('mtype'=>2));
				$this->assign('fields',$fields);
				
				//取表单信息列表, 2=表单模型
				$list = $this->_mflist->get_list($diyid,2);
				$this->assign('list',$list);
				
				$this->assign('diyid',$diyid);
				$this->display();
		}
		
		
		/*
		*	表单信息查看详情
		* @diyid 表单的ID/模型ID
		*	@id diyform_list表 信息id
		*/
		function view()
		{
				$diyid = $this->_request('diyid', 'intval');
				$id = $this->_request('id', 'intval');
				(!$id || !$diyid) && $this->error(L('_PARAM_ERROR_'));
				
				!$this->_list_mod->find($id) && $this->error(L('_PARAM_ERROR_'));
				
				$info = $this->_mflist->get_one($diyid,$id,2);
				$this->assign('info',$info);
				
				$diyform_title = $this->_mod->get_diyform($diyid,'title');
				$this->assign('diyform_title',$diyform_title);
				$this->assign('diyid',$diyid);
				
				$this->display();
		}
		
		
		/*
		* 删除表单信息记录
		*/
		function delete_info($id=null,$return=false)
		{
			if($id==null){
				$id = trim($this->_request('id'),',');
			}

			if (false !== $this->_list_mod->where(array('id'=>array('in',$id)))->delete()) {
				$this->_mflist->where(array('aid'=>array('IN',$id),'mtype'=>2))->delete();		//删除相关字段
				if($return==false){
					IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
					$this->success(L('operation_success'));
				}else{
					return true;
				}
			} else {
				if($return==false){
					IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
					$this->error(L('operation_failure'));
				}else{
					return false;
				}
			}
			
		}	


		/* 表单预览 */
		function preview()
		{
		
			$diyid = $this->_request('id','intval');
			!$diyid && $this->error(L('operation_failure'));
			$this->assign('id',$diyid);
			
			if (false === $diyinfo = F('diyinfo_'.$diyid)) {
					$diyinfo = $this->_mod->get_diyform($diyid);
					exit;
			}
			if($diyinfo['status']==0){
				$this->error(sprintf(L('not_exist'),L('diyform')));
				exit;
			}
			$this->assign('diyinfo',$diyinfo);
			$this->assign('seo_title',$diyinfo['title']);
					
		
			//附加字段
			$fields = D('model_fields')->get_fields($diyid,array('mtype'=>2));
			$add_fields = D('model_fields')->fields_input($fields,0,2);
			if($add_fields)
			{
				$this->assign('has_fields',true);
				$this->assign('add_fields',$add_fields);
				if($add_fields['imglist']){
					$this->assign('imglist',$add_fields['imglist']);
				}
				unset($add_fields['imglist']);
			}
			
			$this->assign('iframe_tools',true);	
			$this->display();
		}


		/* 表单预览 测试添加 */
		function testadd()
		{

			if(!IS_POST){
				$this->error(L('operation_failure'));	
				exit;
			}
			
			
			print_r($this->_post());

			echo '<p>看到此页面说明数据正常提交过来，此页面为测试提交数据，可以不用理会 <a href="javascript:window.close();">【关闭页面】</a></p>';
			
		
		}



		/*
		* 删除表单
		* 删除表单下的信息列表
		*/
		public function delete(){
			$ids = trim($this->_request('id'), ',');

			$id_arr = explode(',', $ids);
			$complete = false;
			$infoid_arr = array();
			foreach ($id_arr as $diyid) {

				$infoids = $this->_list_mod->where(array('diyid'=>$diyid))->field('id')->select();
				foreach ($infoids as $info) {
					$infoid_arr[] = $info['id'];
				}
				$this->delete_info($infoid_arr,true);	//删除信息列表
				$this->_mod->where(array('id'=>$diyid))->delete();	//删除分类
				// echo $this->_mod->getLastSql();

				$complete = true;
			}

			if (false !== $complete) {
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
				$this->success(L('operation_success'));
			} else {
				IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
				$this->error(L('operation_failure'));
			}

		}

}