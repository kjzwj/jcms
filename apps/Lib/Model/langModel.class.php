<?php

class langModel extends Model {
    
		//语言列表
		function langlist()
		{
			$list = $this->where(array('status'=>1))->select();
			$lang_list = array();
			foreach($list as $key=>$val){
				$lang_list[$val['code']] = $val;
			}
			F('lang_list', $lang_list);
			return $lang_list;
		}
		
		function checklang($code)
		{
			$code = trim($code);
			$lang = $this->where(array('code'=>$code,'status'=>1))->find();
			if($lang)
			{
				return true;
			}
		}
}