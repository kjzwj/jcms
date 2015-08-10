<?php
/**
 * 控制器基类
 *
 * @author andery
 */
class frontendAction extends baseAction
{
	    protected function _initialize() {
			parent::_initialize();

			// 需要登录权限的操作
			$this->_rank = array(
                'user' => array('index','profile','avatar','bind'),
            );

			$this->_seo();
			$this->_user_rank();
	    }

	    // 检测是否登录
	    protected function access(){
	        // 获取当前用户ID
	        if( user_login() <= 0 ){// 还没登录 跳转到登录页面
	            $this->redirect('user/login','','1','请登录...');
	        }
	    }

	    // 访问授权，会员权限
	    private function _user_rank( $contName=MODULE_NAME, $actName=ACTION_NAME ){
	        $contName = strtolower($contName);
	        $actName = strtolower($actName);

	        if( array_key_exists($contName,$this->_rank) ){
	            if( in_array($actName,$this->_rank[$contName]) ){
	                $this->access();
	            }else if( in_array('all',$this->_rank[$contName]) ){
	                $this->access();
	            }
	        }
	    }

	    // SEO信息
	    protected function _seo( $array=array() ){

			$conf = APP_PATH.'Conf/info.php';

			//如果配置文件不存在，则读取数据库
			if(file_exists($conf))
			{
				$sysinfo = include($conf);
			}else{
				$sysinfo = array();
				$data = M('sysinfo')->where(array('lang'=>$this->lang))->select();
				foreach($data as $val){
					$sysinfo[$val['varname']] = $val['value'];
				}
				$this->_doSaveIni($conf,$sysinfo);				
			}

	        $seo['title'] = $array['title']?$array['title'].' - '.$sysinfo['sys_sitename']:$sysinfo['sys_sitename'];
	        $seo['keywords'] = $array['keys']?$array['keys']:$sysinfo['sys_keywords'];
	        $seo['description'] = $array['desc']?$array['desc']:$sysinfo['sys_description'];
	        $this->assign('seo',$seo);
	    }


		//前台统一保存数据
		protected function save($mod,$data)
		{
			!$mod && $mod = D($this->_name);
			$pk = $mod->getPk();
			
			if (IS_POST) {
					if (false === $data) {
							IS_AJAX && $this->ajaxReturn(0, $mod->getError());
							return false;
					}
					if (method_exists($this, '_before_insert')) {
							$data = $this->_before_insert($data);
					}
					
					if($this->lang != "" && !$data['lang']){
							$data['lang'] = $this->lang;
					}
					if( $mod->add($data) ){
							if( method_exists($this, '_after_insert')){
									$id = $mod->getLastInsID();
									$this->_after_insert($id);
							}
							IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
							return true;
					} else {
							IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
							return false;
					}					
			}
			
		}
		
		/*
		* 模板输出，给模板加上路径
		*/
		protected function theme($name,$path=false){

			$theme_path = C('THEME_DIR').C('sys_skin').'/';
			$this->assign('theme_path',$theme_path);
			
			if(!strstr($name,C('TMPL_TEMPLATE_SUFFIX'))) {
				$name = $name.C('TMPL_TEMPLATE_SUFFIX');
			}
			
			$file = $name;
			switch ($path) {
				case 'system':
					$file = C('THEME_DIR').'system/'.$name;
					break;
				case 'user':
					$file = C('THEME_DIR').'user/'.$name;
					break;
				default:
					$file = $theme_path.$name;
					break;
			}

			if(!is_file($file)){
				$this->error('模板不存在<br>'.$name,'javascript:;');
			}

			$this->display($file);
				
		}
		

		//修改配置文件
		private function _doSaveIni($ini,$array)
		{
			$string_start = "<?php\nreturn "; 
			$string_body = var_export($array, TRUE); 
			$string_end = ";";
			
			$string = $string_start.$string_body.$string_end; //开始写入文件 
			if(file_put_contents($ini, $string)){
				 return true;
			}
			return false;
		}
		
		
}