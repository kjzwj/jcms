<?php
/*
	文件管理
*/
class attachmentAction extends frontendAction {
	
	public function _initialize() {
			parent::_initialize();
	}
	
	public function index(){
		$type = $this->_request('type','trim','images');
		$this->assign('type',$type);
		$this->theme('attachment','system');
	}

	public function load(){	
		error_reporting(0); // Set E_ALL for debuging
		
		import("@.ORG.elfinder.elFinderConnector");
		import("@.ORG.elfinder.elFinder");
		import("@.ORG.elfinder.elFinderVolumeDriver");
		import("@.ORG.elfinder.elFinderVolumeLocalFileSystem");
		//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
		//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
		//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
		//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
		// Required for MySQL storage connector
		// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
		// Required for FTP connector support
		// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';
		
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
		$opts = array(
			//'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => BASE_PATH.'/uploads/',         // path to files (REQUIRED)
					'URL'           => __ROOT__.'/uploads/', // URL to files (REQUIRED)
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
					'	<button class="btn J_opendialog" data-uri="'.U('home/attachment/index',array('type'=>'image')).'" data-name="JS_'.$name.$i.'" data-width="800" data-title="'.L('selet_images').' (双击选择)" type="button">'.L('selet_images').'</button>'.
					'	</div>'.
					'	<input name="addfields['.$name.'][]" type="text" value="'.$text.'" class="input-medium">'.
					'	<button class="btn btn-link" type="button" onclick="del_images($(this),\''.$name.'\');">'.L('del_images').'</button>'.
					'</div>'.
					'</div>';
			
			echo $html;
	}
	
	
}
