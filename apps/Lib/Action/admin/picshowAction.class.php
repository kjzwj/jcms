<?php
class picshowAction extends backendAction {

		public function _initialize() {
				parent::_initialize();
				$this->_mod = D('picshow');
		}
		
		
		function _before_add()
		{
			$html = new Html();
			$advertising_list = $this->get_advertising();
			$input_data = join(',',$advertising_list);
			$advertising = $html->input('select','advertising',$input_data,'advertising');
			
			$this->assign('advertising',$advertising);									//广告位
			$this->assign('iframe_tools',true);													//iFrame弹窗
		}
		
		function _before_edit()
		{
			$html = new Html();
			$advertising_list = $this->get_advertising();
			$input_data = join(',',$advertising_list);
			$selected = $this->_mod->where(array('id'=>$this->_get('id')))->getField('advertising');
			$advertising = $html->input('select','advertising',$input_data,'advertising','',$selected);
			
			$this->assign('advertising',$advertising);									//广告位
			$this->assign('iframe_tools',true);													//iFrame弹窗
		}
		
		
		//添加广告位
		function advertising()
		{
			$this->assign('iframe_tools',true);													//iFrame弹窗
			$this->display();
		}
		
		//广告位
		private function get_advertising()
		{
			$advertising = $this->_mod->field('id,advertising')->group('advertising')->select();
			$advertising_list = array();
			foreach($advertising as $val)
			{
					$advertising_list[] = $val['advertising'];
			}
			return $advertising_list;
		}
}