<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

defined('THINK_PATH') or exit();
/**
 * EaseTemplate模板引擎驱动 
 * @category   Extend
 * @package  Extend
 * @subpackage  Driver.Template
 * @author    liu21st <liu21st@gmail.com>
 */
class TemplateSmarty {
    /**
     * 渲染模板输出
     * @access public
     * @param string $templateFile 模板文件名
     * @param array $var 模板变量
     * @return void
     */
    public function fetch($templateFile,$var) {
       	//$templateFile   =   substr($templateFile,strlen(THEME_PATH));
				$templateFile		=		trim($templateFile);
        vendor('Smarty.Smarty#class');
        $smarty            =   new \Smarty();
        $smarty->caching       = C('TMPL_CACHE_ON');
        $smarty->template_dir  = THEME_PATH;
        $smarty->compile_dir   = CACHE_PATH ;
        $smarty->cache_dir     = TEMP_PATH ;        
        if(C('TMPL_ENGINE_CONFIG')) {
            $config  =  C('TMPL_ENGINE_CONFIG');
            foreach ($config as $key=>$val){
                $smarty->{$key}   =  $val;
            }
        }
												
        $smarty->assign($var);
        $smarty->display($templateFile);
    }
}