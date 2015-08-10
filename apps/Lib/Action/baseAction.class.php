<?php
/**
 * 控制器基类
 *
 * @author andery
 */
class baseAction extends Action
{
    protected function _initialize() {
		//切换语言
		$this->lang = strtolower(cookie('jcms_lang'));
		$this->load_lang();
		$this->_name = strtolower($this->getActionName());	//小写
		// $this->_mod = D($this->_name);
        if(!isset($_SESSION['jcmsRelease']))
            $this->checkRelease();
    }
    
    public function _empty() {
        $this->_404();
    }
    
    protected function _404($url = '') {
        if ($url) {
            redirect($url);
        } else {
            send_http_status(404);
            $this->display(TMPL_PATH . '404.tpl');
            exit;
        }
    }
		
		
    /**
     * AJAX返回数据标准
     *
     * @param int $status
     * @param string $msg
     * @param mixed $data
     * @param string $dialog
     */
    protected function ajaxReturn($status=1, $msg='', $data='', $dialog='') {
        parent::ajaxReturn(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'dialog' => $dialog,
        ));
    }
	

    // 加载语言
	function load_lang()
	{
		if (false === $lang = F('lang_list')) {
				$lang = D('lang')->langlist();
		}			
		$this->assign('lang_list',$lang);
		$lang[$this->lang]['name'];
		$this->assign('jcms_lang',$lang[$this->lang]['name']);
		
		//启用系统配置
		//$langlist = C('LANG_LIST');
		//$lang = explode(',',$langlist);
		//return $lang;
	}


    private function checkRelease(){
        if( strtolower(GROUP_NAME)!='admin' )
            return false;

        $uri = "http://www.yundes.com/api/jcms.php";
        $post['action'] = base64_encode('release');
        $post['version'] = base64_encode(WJ_RELEASE);
        $post['host'] = base64_encode($_SERVER['HTTP_HOST']);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        $data = curl_exec($curl);
        curl_close($curl);
        // 保存session
        session('jcmsRelease',$data);
    }


    
		
}