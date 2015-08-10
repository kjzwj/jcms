<?php
class model_fieldsAction extends backendAction {

		public function _initialize() {
				parent::_initialize();
		
				$this->modelid = $this->_request('modelid','intval');
				!$this->modelid && $this->error(L('model_error'));
				$this->mtype = $this->_get('mtype','intval',1);	//1:内容模型，2表单模型
				$this->assign('modelid',$this->modelid);
				$this->assign('mtype',$this->mtype);
				
				$this->_mod = D('model_fields');
		}
		
		function _before_index()
		{
			$this->assign('has_botton',true);
		}
		
		function _search()
		{
			$modelid = $this->modelid;
			$mtype = $this->mtype;

			if($mtype==2){
				$modelname = M('diyform')->where(array('id'=>$modelid))->getField('title');
				$modelname = L('diyform').':'.$modelname;
			}else{
				$modelname = M('model')->where(array('id'=>$modelid))->getField('name');
			}
			$this->assign('modelname',$modelname);
			
			$map = array();
			$map['mtype'] = $mtype;
			$map['modelid'] = $modelid;
			return $map;			
		}
		
		
		function _before_add()
		{
			$html = new Html();
			$fields_type = $this->_mod->site_model_fields();	
			$this->assign('fields_type',$html->select($fields_type,'formtype'));
			
			$regexp = $this->_mod->regexp();	
			$this->assign('verification_select',$html->select($regexp,'verification_select','', 'id="J_verification_select" style="width:100px"'));
		}
		
		function _before_edit()
		{
			$fields_type = $this->_mod->site_model_fields();	
			$this->assign('fields_type',$fields_type);
			
			$regexp = $this->_mod->regexp();	
			$this->assign('verification_select',$regexp);
		}
		
		
		function _before_insert($data)
		{
				if ($this->_mod->field_exists($data['field'], $data['modelid'],$data['mtype'])) 
				{
					$this->error(sprintf(L('is_exist'),L('field_name')));
					return false;
					exit;					
				}else{
					return $data;
				}
		}

		
	    public function ajax_check_name()
	    {
	        $field = $this->_get('field', 'trim');
					$mtype = $this->_get('mtype', 'intval',$this->mtype);
	        $modelid = $this->_get('modelid', 'intval',$this->modelid);
	        if ($this->_mod->field_exists($field,$modelid,$mtype)) {
	            $this->ajaxReturn(0, sprintf(L('is_exist'),L('field_name')));
	        } else {
	            $this->ajaxReturn(1);
	        }
	    }


	    /*
		* 删除字段
		* 同时会删除相关字段
		*/
		function delete()
		{
			$ids = trim($this->_request('id'), ',');
			
			if (false !== $this->_mod->delete($ids)) {
					M('mflist')->where(array('fieldsid'=>array('IN',$ids)))->delete();		//删除相关字段
					IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
					$this->success(L('operation_success'));
			} else {
					IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
					$this->error(L('operation_failure'));
			}
			
		}
	

}