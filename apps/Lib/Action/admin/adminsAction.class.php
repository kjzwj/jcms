<?php
class adminsAction extends backendAction {

	public function _initialize() {
			parent::_initialize();
			$this->_mod = D('admins');
	}


    public function add(){
        if (IS_POST) {

            $data = $this->_mod->create();

            $res = $this->_mod->add_user($data);
            if( $res['status']==1 ) {
                $this->success($res['msg'],U('index'));
            }else{
                $this->error($res['msg']);
            }
        }else{
            $this->assign('open_validator', true);
            $this->display();
        }

    }


    // 前置操作
    public function _before_update($data){

        if($data['id']=='1' and $data['status']==0){
            $this->error('最后一个了，状态不能禁用哦');
            exit;
        }
    
        $info = $this->_mod->find($data['id']);
        if( $info['password']!=$data['password'] ){
            !$info['salt'] && $data['salt']=$info['salt'] = user_salt();
            $data['password'] = user_md5($data['password'].$info['salt']);
        }
        return $data;
    }


    public function ajax_check_name()
    {
        $field = $this->_get('username', 'trim');
        if ($this->_mod->field_exists($field)) {
            $this->ajaxReturn(0, sprintf(L('is_exist'),L('username')));
        } else {
            $this->ajaxReturn();
        }
    }

    public function delete(){

        $ids = trim($this->_request('id'), ',');
        $id_arr = explode(',', $ids);
        if(in_array('1', $id_arr)){
            $this->ajaxReturn(0,'最后一个了，不能删除哦');
        }

        if ($ids) {
            if (false !== $this->_mod->delete($ids)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }

    }

    public function ajax_edit(){

        //AJAX修改数据
        $id = $this->_get('id', 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');

        if($id=='1'){
            $this->ajaxReturn(0);
            exit;
        }
        //允许异步修改的字段列表  放模型里面去 TODO
        $this->_mod->where(array('id'=>$id))->setField($field, $val);
        $this->ajaxReturn(1);

    }

    
		
}