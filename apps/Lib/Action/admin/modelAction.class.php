<?php
class modelAction extends backendAction {

		public function _initialize() {
				parent::_initialize();
				$this->_mod = D('model');
		}
	
    public function ajax_check_name()
    {
        $name = $this->_get('name', 'trim');
				$tablename = $this->_get('tablename', 'trim');
        $id = $this->_get('id', 'intval');
				$field = $tablename ? 'tablename' : 'name';
				$value = $tablename ? $tablename : $name;
        if ($this->_mod->name_exists($value, $id, $field)) {
            $this->ajaxReturn(0, '名称已经存在');
        } else {
            $this->ajaxReturn();
        }
    }	


    /* 
    前置操作
    */
    public function _before_add()
    {
        $this->assign('iframe_tools',true);
    }


    /* 
    前置操作
    */
    public function _before_edit()
    {
        $this->assign('iframe_tools',true);
    }


    /*
    * 删除模板
    * 如模型下有文章则不能删除
    */
    function delete()
    {
        $id = $this->_request('id');

        $issystem = $this->_mod->where('id='.$id)->getField('issystem');
        if($issystem==1)
        {
            //系统模型不能删除
            IS_AJAX && $this->ajaxReturn(0, L('model_is_system'));
            $this->error(L('model_is_system'));
            exit;
        }

        $count = M('content')->where(array('modelid'=>$id))->count();
        if($count>0)
        {
           //有数据不能删除
            IS_AJAX && $this->ajaxReturn(0, L('model_has_content'));
            $this->error(L('model_has_content'));
            exit;
        }else{

            if (false !== $this->_mod->delete($ids)) {
                    IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                    $this->success(L('operation_success'));
            } else {
                    IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                    $this->error(L('operation_failure'));
            }
        }

    }

}