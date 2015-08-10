<?php
/* 
* 模板自定义标签
* J-cms模板标签
* by zwj
* Email: is-zwj@qq.com
*/
class TagLibArticle extends TagLib
{
    protected $tags = array(
			'list' => array('attr' => 'catid,order,image,flag,limit,pagesize,fields,item','level'=>3,'close'=>1),	// attr 属性列表,	 close 是否闭合（0 或者1 默认为1，表示闭合）
			'catelist' => array('attr' => 'catid,item','level'=>3,'close'=>1),	// attr 属性列表,	 close 是否闭合（0 或者1 默认为1，表示闭合）
			'category'	=>	array('attr'=>'id,name','close'=>0), // input标签
			'template'	=>	array('attr'=>'file,type', 'close'=>0),
			'block'		=>	array('attr'=>'pos', 'close'=>0),
			'adset'		=>	array('attr'=>'pos,item', 'close'=>1),	//广告列表
		);
		
		
		/*
		* 文章列表标签
		* <list item="val" catid="1,2" limit="20" order="ordid desc,id desc" image="0" flag="r" fields="id,cat_id,title,image,addtime" pagesize="10">
		* limit 与 pagesize 不能同时使用，有分页时用pagesize
		*/		
		function _list($attr,$content)
		{
				$tag = $this->parseXmlAttr($attr,'list');
				
				$catid 			= $tag['catid']?$tag['catid']:0;
				$order 			= $tag['order'];
				$image 			= $tag['image'];
				$flag 			= $tag['flag'];
				$fields 		= $tag['fields'];
				$limit 			= $tag['limit'];
				$pagesize 	= $tag['pagesize'];
				
				$str = '<?php ';
				$str .= '$map[\'catid\']='.$catid.';';
				$str .= '$map[\'limit\']="'.$limit.'";';
				$str .= '$map[\'order\']="'.$order.'";';
				$str .= '$map[\'image\']="'.$image.'";';
				$str .= '$map[\'flag\']="'.$flag.'";';
				$str .= '$map[\'fields\']="'.$fields.'";';
				$str .= '$map[\'pagesize\']="'.$pagesize.'";';
				$str .= '$_data = D(\'content\')->get_list($map);';
				$str .= '$_list=$_data[\'list\'];';
				$str .= '$_total=$_data[\'_total\'];';
				$str .= '$_page=$_data[\'_page\'];';
				$str .= 'foreach ($_list as $'.$tag['item'].'):';
				//$str .= 'extract($_list_value);';
				$str .= '$'.$tag['item'].'[\'url\']=U("content/view",array("id"=>$'.$tag['item'].'[\'id\']));?>';//自定义文章生成路径$url
				$str .= $content;
				$str .='<?php endforeach; ?>';
				return $str;
		}


		/*
		* 分类列表标签
		* <catelist catid="1" item="val" key="key" limit="20" isnav="0" iamge="0" fields="id,name,alias,image,pid" order="ordid asc,id desc" self="0" addend="10,11">
		*/	
		function _catelist($attr,$content)
		{
				$tag = $this->parseXmlAttr($attr,'catelist');
				
				$catid 			= $tag['catid']?$tag['catid']:0;
				$order 			= $tag['order'];
				$fields 		= $tag['fields'];
				$limit 			= $tag['limit'];
				$where			= $tag['where'];
				$isnav			= $tag['isnav'];
				$key			= $tag['key']?$tag['key']:'key';
				$addend			= trim($tag['addend'],',');

				$str = '<?php ';
				$str .= '$map[\'catid\']='.$catid.';';
				$str .= '$map[\'limit\']="'.$limit.'";';
				$str .= '$map[\'order\']="'.$order.'";';
				$str .= '$map[\'where\']="'.$where.'";';
				$str .= '$map[\'fields\']="'.$fields.'";';
				$str .= '$map[\'isnav\']="'.$isnav.'";';
				$str .= '$self="'.$tag['self'].'";';
				$str .= '$addend="'.$addend.'";';
				$str .= '$_cate_list = D(\'category\')->get_list($map,$self,$addend);';
				$str .= 'foreach ($_cate_list as $'.$key.'=>$'.$tag['item'].'):';
				//$str .= 'extract($_list_value);';
				$str .= '$'.$tag['item'].'[\'url\']=U("content/index",array("cid"=>$'.$tag['item'].'[\'id\']));?>';
				$str .= $content;
				$str .='<?php endforeach; ?>';
				return $str;
				
		}
		
		
		
		/* 
		* 返回分类信息
		* <category id="1" name="name" />
		* @name 返回的字段
		*/
		function _category($attr,$content)
		{
				$tag    = $this->parseXmlAttr($attr,'category');
				$name   = $tag['name'];
				$id     = $tag['id']?$tag['id']:0;
				
				$str = '<?php ';
				$str .= '$id='.$id.';';
				$str .= '$category=D(\'category\')->get_info($id);';
				$str .= '$category[\'url\']=U("content/index",array("cid"=>$category[\'id\']));';//$url
				$str .= 'echo $category[\''.$name.'\'];';
				$str .= ' ?>';
				
				return $str;
		}


		/* 
		* 载入模板
		* <template file="header.tpl" />
		* @file 文件名称，默认当前模板路径
		*/
		function _template($attr,$content)
		{
				$tag    = $this->parseXmlAttr($attr,'template');
				$file   =  trim($tag['file']);
				$type   =  trim($tag['type']);

				switch ($type) {
					case 'system':
						$theme_path = C('THEME_DIR').'system/';
						break;
					case 'user':
						$theme_path = C('THEME_DIR').'user/';
						break;
					default:
						$theme_path = C('THEME_DIR').C('DEFAULT_THEME').'/';
						break;
				}
				
				if(!strstr($file,C('TMPL_TEMPLATE_SUFFIX'))) {
					$file = $file.C('TMPL_TEMPLATE_SUFFIX');
				}

				// if(!$this->view) $this->view	= Think::instance('View');
				// $file=$theme_path.$file;
				// $str = $this->view->fetch($file,$this->tVar);

				$str = '<?php ';
				$str .= 'if(!$this->view) $this->view	= Think::instance(\'View\');';
				$str .= '$this->view->display(\''.$theme_path.$file.'\',$this->tVar);';
				$str .= ' ?>';

				return $str;
		}


		/* 
		* 调用静态块
		* <block pos="footer" />
		* @pos 调用名称
		*/
		function _block($attr,$content)
		{
				$tag    = $this->parseXmlAttr($attr,'block');
				$pos   =  trim($tag['pos']);

				if(false===$block=F('block_'.$pos)){
					$block = D("block")->get_pos($pos);
				}

				$str = $block['content'];
				return $str;
		}



		/* 
		* 调用静态块
		* <adset pos="广告位名称" item="ad">
		* @pos 调用名称
		*/
		function _adset($attr,$content)
		{
				$tag    = $this->parseXmlAttr($attr,'adset');
				$pos   =  trim($tag['pos']);

				if(!$pos)
					return false;

				$str = '<?php ';
				$str .= '$pos="'.$pos.'";';
				$str .= '$_picshow=D(\'picshow\')->get_list($pos);';
				$str .= 'foreach ($_picshow as $'.$tag['item'].'):';
				$str .= '?>';
				$str .= $content;
				$str .='<?php endforeach; ?>';

				return $str;
		}
		
		
}