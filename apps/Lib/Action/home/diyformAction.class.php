<?php
class diyformAction extends frontendAction {

	public function _initialize()
	{
			parent::_initialize();
	}

	function index()
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
	
	
	function add()
	{
		if(!IS_POST){
			$this->error(L('operation_failure'));	
			exit;
		}


		$diyid = $this->_post('diyid');
		$diyinfo = D('diyform')->get_diyform($diyid);
		if (!$diyinfo) {
			$this->error(sprintf(L('not_exist'),L('diyform')));
			exit;
		}
		if($diyinfo['status']==0){
			$this->error(sprintf(L('not_exist'),L('diyform')));
			exit;
		}
		$data = $_POST['addfields'];

		$fields = D('model_fields')->get_fields($diyid,array('mtype'=>2));
		$mod = D('diyform_list');
		$LastInsID = false;
		foreach($data as $k=>$v){
			if(array_key_exists($k,$fields))
			{
				$error = $fields[$k]['errortips'];

				//检测是否为空
				if($fields[$k]['required']==1 && empty($data[$k]))
				{	
					if(!$error){
						$error = sprintf(L('field_required'),$fields[$k]['name']);
					}
					$this->error($error);
				}

				//验证限制格式
				if($fields[$k]['verification'])
				{
					if(!preg_match("/{$fields[$k]['verification']}/",$v)){
						if(!$error)
							$error = sprintf(L('format_error'),$fields[$k]['name']);
						
						$this->error($error);
					}
				}//验证限制格式
				
				//转换数据
				if(is_array($v))
				{
						$v = join('|||',$v);
				}//转换数据end
				
				//主表
				if($LastInsID===false)
				{
					$this->save($mod,array('diyid'=>$diyid,'uid'=>0,'status'=>1));
					$LastInsID = $mod->getLastInsID();
				}
				//附加表
				if($LastInsID)
				{
					D('model_fields')->save_fields($LastInsID,array('fieldsid'=>$k,'info'=>$v,'modelid'=>$diyid),2);
				}
			}
		}// end foreach

		//发送邮件
		if($diyinfo['sendmail'])
		{
			//邮箱配置
			$mailconfig = C('email');
			$smtpserver = $mailconfig['smtpserver'];
			$smtpserverport = $mailconfig['smtpserverport'];
			$smtpuser = $mailconfig['smtpuser'];
			$smtppass = $mailconfig['smtppass'];

			if($smtpserver && $smtpserverport && $smtpuser && $smtppass)
			{
				$smtpemailto=$diyinfo['toemail'];
				$mailsubject = $diyinfo['title'].' - '.C('sys_sitename');		//邮件主题
				$mailbody = '主人，您的网站有人留言了，赶紧去看看是谁吧！<br><br><a href="'.C('sys_siteurl').'" target="_blank">'.C('sys_siteurl').'</a><br><br>发送时间：'.date('Y年m月d日 H时:i分',time());
				$mailtype = "HTML";//邮件格式（html/txt）,txt为文本邮件
				$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);		//这里面的一个true是表示使用身份验证,否则不使用身份验证.
				$smtp->debug = false;		//是否显示发送的调试信息
				$smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
			}
		}

		unset($LastInsID);
		unset($data);
		unset($fields);
		
		$this->success(L('add_ok'));
	}
	
	

}