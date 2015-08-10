<?php

class diyformModel extends Model {

	/**
	 * 取表单信息(返回数组)
	 */
	public function get_diyform($id,$field='')
	{
		if(!$id) return false;
		$diyinfo = $this->find($id);
		F('diyinfo_'.$id, $diyinfo);
		if($field){
			return $diyinfo[$field];
		}else{
			return $diyinfo;
		}
	}
	
}