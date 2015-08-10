<?php

/**
 * 合并加载JS和CSS文件
 *
 * @author brivio
 */
class loadTag {

    private $jm;
    private $dir;

    function __construct() {
        $this->jm = new JSMin();
        $this->dir = new Dir();
    }
		
		public function js($options) {
        $path = '.'.WEB_DATA . 'temp/' . md5($options['href']) . '.js';
        if (!is_file($path)) {
            //静态资源地址
            $files = explode(',', $options['href']);
            $content = '';
            foreach ($files as $val) {
								if($options['from']=='admin')
								{
									$val = str_replace('__DATA__', '.'.WEB_DATA, $val);
								}else{
									$val = str_replace('__PUBLIC__', '.'.WEB_PUBLIC, $val);
								}
                $content.=file_get_contents($val);
            }
						
            file_put_contents($path, $this->jm->minify($content));
        }
				$src = C('sys_siteurl').ltrim($path,'.');
				echo ( '<script type="text/javascript" src="' . $src . '"></script>' );
    }
		
		
		public function css($options) {
        $path = '.'.WEB_DATA . 'temp/' . md5($options['href']) . '.css';
        if (!is_file($path)) {
            //静态资源地址
            $files = explode(',', $options['href']);
            $content = '';
            foreach ($files as $val) {
								if($options['from']=='admin')
								{
									$val = str_replace('__DATA__', '.'.WEB_DATA, $val);
								}else{
									$val = str_replace('__PUBLIC__', '.'.WEB_PUBLIC, $val);
								}
                $content.=file_get_contents($val);
            }
            file_put_contents($path, $this->jm->minify($content));
        }
				$src = C('sys_siteurl').ltrim($path,'.');
				echo ( '<link href="'. $src .'" rel="stylesheet" />' );
    }
		
}