<?php
/**
* 生成html表单
	@ by iszwj
	@ iszwj.com
*/
class Html {

	
	/**
	* 取HTML 表单字段
	**/
	public function input($type,$name,$value='',$id='',$attribute='',$selected='') {
		$html = '';
		if($type == 'text' || $type == 'int' || $type == 'decimal'|| $type == 'number')
		{
				$html = "<input type='text' name='$name' id='$id' value='$value' $attribute />";
		}
		elseif($type == 'textarea')
		{
				$html = "<textarea name='$name' id='$id' rows='4' $attribute>$value</textarea>";
		}
		elseif($type == 'editor')
		{
				//$html = "<editor type='ueditor' name='$name' id='$id' width='700' content='$value' $attribute></editor>";
				$html = '<script type="text/plain" id="'.$id.'" class="'.$class.'" name="'.$name.'" >'.htmlspecialchars_decode($value).'</script><script type="text/javascript">var editor = new baidu.editor.ui.Editor({"initialFrameWidth":680,"initialFrameHeight":380}); editor.render("'.$id.'");</script>';			
		}
		elseif($type == 'datetime')
		{
				$html = "<input type='text' name='$name' id='$id' value='$value' class='Wdate' onfocus='WdatePicker({dateFmt:\"yyyy-MM-dd HH:mm:ss\"})' $attribute />";
		}
		elseif($type == 'select' || $type == 'radio' || $type == 'checkbox')
		{
				if(!is_array($value))
				{
						$tempdata = explode(',',$value);
						foreach($tempdata as $val){
							$data[$val] = $val;
						}
				}
				$html = $this->$type($data, $name, $selected, ' id="'.$id.'" ');
		}
		elseif($type == 'image')
		{
				$html = "<div class='input-append'><input id='JS_$id' name='$name' type='text' value='$value' $attribute><button class='btn J_opendialog' data-uri='".U('attachment/index',array('type'=>'image'))."' data-name='JS_$id' data-width='800' data-title='".L('selet_images')." (双击选择)' type='button'>".L('selet_images')."</button></div>";
		}
		elseif($type == 'images')
		{
				preg_match('/addfields\[(.\d)\]/i',$name,$str);
				$id = 'images_'.$str[1];
				
				$html = '<div class="form-th"><h5>'.L('more_images').'</h5></div>'.
								'<div id="'.$id.'_area"></div>'.
             		'<div class="form-th"><button class="btn btn-link" type="button" onclick="add_images(\''.$id.'\')">'.L('add_images').'</button>'.
								'<input id="'.$id.'_num" type="hidden" value="0" /></div>';
        /*if(is_array($value)){
					$html .= "<script>$(function(){\n";
							foreach($value as $kkk=>$img){
								$html .= "add_images('{$id}');\n";
							}
					$html .= "}\n</script>";
				}*/
		}
		
		return $html;

	}
	
	//根据数组生成html select
	function select($data=array(), $name='', $selected='', $attribute='')
	{
			$name = trim($name);
			$selected = trim($selected);
			if($data)
			{
				$html = "<select name='$name' $attribute>";
				foreach($data as $key=>$val){
					$html .= "<option value='{$key}' ".(($val==$selected)?'selected="selected"':'').">{$val}</option>";
				}
				$html .= '</select>';
			}
			return $html;
	}	
	
	function radio($data=array(), $name='', $selected='', $attribute='')
	{
			$html = '';
			$name = trim($name);
			$selected = trim($selected);
			if($data)
			{
				foreach($data as $key=>$val){
					$html .= '<label class="radio inline"><input name="'.$name.'" type="radio" value="'.$key.'" '.(($val==$selected)?'checked="checked"':'').' /> '.$val.'</label>';
				}
			}
			return $html;
	}

	
	function checkbox($data=array(), $name='', $selected='', $attribute='')
	{
			$html = '';
			$name = trim($name);
			$selected = trim($selected);
			$arr = array_flip(explode('|||',$selected));	//分割并交换数组中的键和值,避免键为0返回false

			if($data)
			{
				$i=0;
				foreach($data as $key=>$val){
					$html .= '<label class="checkbox inline"><input name="'.$name.'['.$i.']" type="checkbox" value="'.$key.'" '.((array_key_exists($val,$arr))?'checked="checked"':'').' /> '.$val.'</label>';
					$i++;
				}
			}
			return $html;
	}
	
}
?>