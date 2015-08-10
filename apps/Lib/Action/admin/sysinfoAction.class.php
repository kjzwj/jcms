<?php
class sysinfoAction extends backendAction {

	
	public function _initialize() {
		parent::_initialize();
	}

	public function index(){
		$this->assign('curr_name','index');
		$data = M('sysinfo')->where(array('lang'=>$this->lang))->select();
		$html = new Html();
		$info = array();
		foreach($data as $key=>$val){
			$info[$val['tabtype']][$key] = $val;
			if($val['vartype'] == 'bool')
			{
				$val['vartype'] = 'radio';
				$input_data = 'Y,N';
			}else{
				$input_data = $val['value'];
			}
			$info[$val['tabtype']][$key]['html'] = $html->input($val['vartype'],'data['.$val['id'].']',$input_data,$val['varname'],'',$val['value']);
		}
		$this->assign('info',$info);
		$this->display();
	}

	// 邮箱配置
	public function email()
	{
		$ini = APP_PATH.'Conf/info.php';
		if(IS_POST)
		{
			$data['email'] = $this->_post('data');
			$this->_doConf($ini,$data);
			$this->success(L('_OPERATION_SUCCESS_'));
		}else{
			$data = include($ini);
			$this->assign('curr_name','email');

			$this->assign('info',$data['email']);
			$this->display();
		}
	}

	// 网站接入
	public function oauth(){
		$ini = APP_PATH.'Conf/info.php';
		if(IS_POST)
		{
			$data['qq'] = $_POST['data']['qq'];
			$data['weibo'] = $_POST['data']['weibo'];
			$data['weixin'] = $_POST['data']['weixin'];
			$this->_doConf($ini,$data);
			$this->success(L('_OPERATION_SUCCESS_'));
		}else{
			$data = include($ini);
			$this->assign('curr_name','oauth');

			$info['qq'] = $data['qq'];
			$info['weibo'] = $data['weibo'];
			$info['weixin'] = $data['weixin'];
			$this->assign('info',$info);
			$this->display();
		}
	}
	
	public function _before_add(){
		$data = M('sysinfo')->where(array('lang'=>$this->lang))->select();
		$tabnav = array();
		foreach($data as $key=>$val){
			$tabnav[$val['tabtype']][$key] = $val;
		}
		$this->assign('tabnav',$tabnav);
	}
	
	public function _before_edit(){
		$data = M('sysinfo')->select();
		$tabnav = array();
		foreach($data as $key=>$val){
			$tabnav[$val['tabtype']][$key] = $val;
		}
		$this->assign('tabnav',$tabnav);
	}	

	
	//保存配置参数
	public function saveInfo(){
		$data = $this->_post('data');
		foreach($data as $key=>$val)
		{
			M('sysinfo')->where(array('id'=>$key))->save(array('value'=>$val));
		}
		//更新配置文件
		$this->_doConfInfo();
		
		$this->success(L('_OPERATION_SUCCESS_'));
	}
	
	function _doConfInfo()
	{
		$data = M('sysinfo')->where(array('lang'=>$this->lang))->select();
		foreach($data as $val){
			$array[$val['varname']] = $val['value'];
		}
		//模板默认风格目录
		$homeini = APP_PATH.'Conf/home/config.php';
		$home['DEFAULT_THEME'] = $array['sys_skin'];
		$this->_doConf($homeini,$home);

		$ini = APP_PATH.'Conf/info.php';
		$this->_doConf($ini,$array);
	}
	
	//修改配置文件
	private function _doConf($ini,$array){

		$data = include($ini);
		
		$data = array_merge($data,$array);
		
		$string_start = "<?php\nreturn "; 
		$string_body = var_export($data, TRUE); 
		$string_end = ";";
		
		$string = $string_start.$string_body.$string_end; //开始写入文件 
		if(file_put_contents($ini, $string)){
			 return true;
		}	
		return false;	
	}	

}