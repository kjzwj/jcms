<?php
class contentAction extends backendAction {

	public function _initialize()
	{
			parent::_initialize();
			$this->_cate = D('category');
			$this->_mod = D('content');
	}

	protected function _search()
	{
		$cat_id = $this->_request("cat_id", 'intval');
		$cate = $this->_cate->find($cat_id);
		$this->assign('cate',$cate);
		
		$map = array();
		$map['modelid'] = $cate['modelid'];
		$map['cat_id'] = array('in',$this->_cate->get_child_ids($cat_id,true));
		return $map;
	}
	
	
	function _before_insert($data){
		!$data['title'] && $this->error(sprintf(L('require_empty'),L('lable_title')));
		!$data['cat_id'] && $this->error(sprintf(L('require_empty'),L('cate_name')));
		if($data['addtime']){
			$data['addtime'] = strtotime($data['addtime']);
		}else{
			$data['addtime'] = time();
		}
		$data['image'] && $data['flag']['p']='p';
		$data['flag'] = join(',',$data['flag']);

		return $data;
	}

	
	function _before_add($id=0){
		
		
		$cat_id = $this->_request("cat_id", 'intval');
		!$cat_id && $this->error(L('operation_failure'));
		$modelid = $this->_cate->where(array('id'=>$cat_id))->getField('modelid');
		$this->assign('modelid',$modelid);	

		$spid = $this->_cate->get_spid($cat_id);	//取spid
		$this->assign('spid',$spid);
		$this->assign('cat_id',$cat_id);

		//附加字段
		$fields = D('model_fields')->get_fields($this->modelid);
		$add_fields = D('model_fields')->fields_input($fields,$id);
		if($add_fields)
		{
			$this->assign('has_fields',true);
			$this->assign('add_fields',$add_fields);
			if($add_fields['imglist']) $this->assign('imglist',$add_fields['imglist']);
			unset($add_fields['imglist']);
		}
		
		//通用数据
		$this->assign('iframe_tools',true);													//iFrame弹窗
		$this->assign('flag',D('content')->get_flag());							//文章属性
		$this->assign('access',D('content')->get_access_temp());		//访问权限（临时）
		
	}
	
	
	//前置方法操作
	function _before_edit()
	{	
		$id = $this->_request("id", 'intval');
		!$id && $this->error(L('operation_failure'));	

		$this->_before_add($id);
	}
	
	function _before_update($data)
	{
		$data = $this->_before_insert($data);
		return $data;
	}	
	
	
	//后置方法操作
	function _after_insert($data)
	{	
		//处理附加字段
		$addfields = $_POST['addfields'];
		$modelid = $this->_post('modelid','intval');
		if(is_array($addfields))
		{
				foreach($addfields as $key=>$val)
				{
					if(is_array($val))
					{
							$val = join('|||',$val);
					}
					D('model_fields')->save_fields($data,array('fieldsid'=>$key,'info'=>$val,'modelid'=>$modelid));
				}//end foreach
		}//end if
	}
		
	function _after_update($data)
	{
		$data = $this->_after_insert($data);
	}		
	
	/*
	ajax取当前模型分类
	*/
	public function ajax_getchilds()
	{
			$id = $this->_request('id', 'intval');
			$type = $this->_request('type', 'intval', '0');
			$modelid = $this->_request('modelid', 'intval', '0');

			$map = array('pid'=>$id,'lang'=>$this->lang,'modelid'=>$modelid);

			if (!is_null($type)) {
					$map['type'] = $type;
			}
			
			$return = D('category')->field('id,name')->where($map)->select();
			if ($return) {
					$this->ajaxReturn(1, L('operation_success'), $return);
			} else {
					$this->ajaxReturn(0, L('operation_failure'));
			}
	}
	
	
	/*
	* 删除文章记录
	* 同时会删除相关附加字段
	*/
	function delete()
	{
		$ids = trim($this->_request('id'), ',');
		
		if (false !== $this->_mod->related_delete($ids)) {
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		} else {
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		}
		
	}


	/*
	批量移动
	*/
	function move()
	{
		
		if (IS_POST)
		{
			$pid = $this->_post('pid', 'intval');
            $ids = $this->_post('ids');

            $id_arr = explode(',', $ids);
			$aid = $id_arr[0];

			$info = $this->_mod->find($aid);
			$category = $this->_cate->get_info($info['cat_id']);

			$modelid = $info['modelid'];
			$type = $category['type'];
			//检查移动分类是否合法
            $target_cate = $this->_cate->find($pid);
            if($target_cate['type']!=$type || $target_cate['modelid']!=$modelid)
            {
            	IS_AJAX && $this->ajaxReturn(0, L('target_category_error'));
            	$this->error(L('target_category_error'));
            	exit;
            }
            
            $this->_mod->where(array('id' => array('in', $ids)))->save(array('cat_id'=>$pid));
            IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            $this->success(L('operation_success'));
		}
		else
		{

			$ids = trim($this->_request('id'), ',');
			$id_arr = explode(',', $ids);
			$aid = $id_arr[0];
			$info = $this->_mod->find($aid);
			$category = $this->_cate->get_info($info['cat_id']);

			$modelid = $info['modelid'];
			$type = $category['type'];

			$this->assign('modelid', $modelid);
			$this->assign('type', $type);
            $this->assign('ids', $ids);
            $resp = $this->fetch();
            $this->ajaxReturn(1, '', $resp);
        }
	}
	
	
	
}