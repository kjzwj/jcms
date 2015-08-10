<?php
class indexAction extends backendAction {

	public function _initialize() {
			parent::_initialize();
	}
	
    public function index(){
        $this->redirect('sysinfo/index');
    }


    public function clearCache(){

		import('ORG.Dir');
		Dir::delDir(RUNTIME_PATH);
		$this->success(L('operation_success'));
		
    }

}