<?php

class picshowModel extends Model {
	
	//自动验证
	protected $_validate = array(
		array('name','require','{%name_require}'), 
		array('advertising','require','{%advertising_require}'),
		array('adpic','require','{%adpic_require}'),
	);
		

	/*
	* 读取广告位广告列表
	* @ $pos 默认值
	* @ lang 语言
	*/
	public function get_list($pos='')
	{

		if(!$pos)
			return false;

		$where = array();
		$where['lang']	=	$this->lang;
		$where['advertising'] = trim($pos);
		
		$data = $this->where($where)->select();

		// echo $this->getLastSql();

		return $data;
	}
	
}