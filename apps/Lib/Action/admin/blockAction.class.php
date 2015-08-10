<?php
class blockAction extends backendAction {

	public function _initialize() {
			parent::_initialize();
			$this->_mod = D('block');
	}

    public function ajax_check_name()
    {
        $field = $this->_get('cell_name', 'trim');
        if ($this->_mod->field_exists($field)) {
            $this->ajaxReturn(0, sprintf(L('is_exist'),L('cell_name')));
        } else {
            $this->ajaxReturn();
        }
    }

    //后置操作方法
    function _after_update($data)
    {
        $pos = $this->_mod->where(array('id'=>$data))->getField('cell_name');
        //清除缓存
        F("block_{$pos}",NULL);
    }
		
}