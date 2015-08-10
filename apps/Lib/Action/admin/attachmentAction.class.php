<?php
/*
	文件管理
*/
class attachmentAction extends backendAction {
	
	public function _initialize() {
			parent::_initialize();
	}
	
	public function index(){
		$type = $this->_request('type','trim','images');
		$this->assign('type',$type);
		$this->display();
	}

	public function load(){	
		error_reporting(0); // Set E_ALL for debuging

		$type = $this->_request('type','trim','images');
		
		import("@.ORG.elfinder.elFinderConnector");
		import("@.ORG.elfinder.elFinder");
		import("@.ORG.elfinder.elFinderVolumeDriver");
		import("@.ORG.elfinder.elFinderVolumeLocalFileSystem");
		
		/**
		 * Simple function to demonstrate how to control file access using "accessControl" callback.
		 * This method will disable accessing files/folders starting from  '.' (dot)
		 *
		 * @param  string  $attr  attribute name (read|write|locked|hidden)
		 * @param  string  $path  file path relative to volume root directory started with directory separator
		 * @return bool|null
		 **/
		function access($attr, $path, $data, $volume) {
			return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
				? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
				:  null;                                    // else elFinder decide it itself
		}

		switch ($type) {
			case 'tpl':
				$path = BASE_PATH.'/themes/'.C('sys_skin');
				$URL = '/';
				break;
			default:
				$path = BASE_PATH.'/uploads/';
				$URL = __ROOT__.'/uploads/';
				break;
		}
		$opts = array(
			//'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => $path,         // path to files (REQUIRED)
					'URL'           => $URL, // URL to files (REQUIRED)
					'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
				)
			)
		);
		
		// run elFinder
		$connector = new elFinderConnector(new elFinder($opts));
		$connector->run();
	}
	
	
	//取上传框
	function upload_input()
	{
		$name = $this->_request('name','trim','images');
		$btn = $this->_request('btn','trim',L('selet_images'));
		$i = $this->_request('lp','intval',1);
		$imgurl = $this->_request('imgurl','trim','');
		$text = $this->_request('text','trim','');
		
		$html = '<div class="row-fluid '.$name.'_row">'.
							'<label class="control-label">'.L('image').$i.'</label>'.
							'<div class="controls">'.
							'	<div class="input-append">'.
							'	<input id="JS_'.$name.$i.'" name="addfields['.$name.'][]" type="text" value="'.$imgurl.'" class="input-large">'.
							'	<button class="btn J_opendialog" data-uri="'.U('attachment/index',array('type'=>'image')).'" data-name="JS_'.$name.$i.'" data-width="800" data-title="'.L('selet_images').' (双击选择)" type="button">'.L('selet_images').'</button>'.
							'	</div>'.
							'	<input name="addfields['.$name.'][]" type="text" value="'.$text.'" class="input-medium">'.
							'	<button class="btn btn-link" type="button" onclick="del_images($(this),\''.$name.'\');">'.L('del_images').'</button>'.
							'</div>'.
							'</div>';
		
		echo $html;
	}
	
	
}
