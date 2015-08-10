<?php

class blockModel extends Model {
	
		//自动验证
		protected $_validate = array(
			array('title','require','{%block_name_require}'), //默认情况下用正则进行验证
			array('cell_name','','{%cell_name_require}',0,'unique',3),
		);

    /**
     * 检测链接字段名是否存在
     *
     * @param string $name
     * @param int $pid
     * @return bool
     */
    public function field_exists($field)
    {
		$pk = $this->getPk();
		$where = array();
		$where['cell_name'] = $field;
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    /*
	根据调用名称取内容
    */
    function get_pos($pos)
    {
    	$info = $this->where(array('cell_name'=>$pos))->find();
    	F("block_{$pos}", $info);
    	return $info;
    }
		
		
		//全站模型字段类型
		public function site_model_fields()
		{
			$array = array(
				'text'				=>		'单行文本',
				'textarea'		=>		'多行文本',
				'editor'			=>		'编辑器',
				'checkbox'		=>		'Checkbox多选项框',
				'radio'				=>		'Radio单选组',
				'select'			=>		'Select下拉菜单',
				'image'				=>		'图片',
				'images'			=>		'多图片',
				'int'					=>		'整数',
				'decimal'			=>		'小数类型',
				'datetime'		=>		'日期和时间',
				'linkage'			=>		'联动菜单',
			);	

			return $array;
		}
		
		//正则验证规则
		function regexp()
		{
			$array = array(
            '' => '常用正则',
						'^[0-9.-]+$' => '数字',
            '^[0-9-]+$' => '整数',
            '^[a-z]+$/i' => '字母',
            '^[0-9a-z]+$/i' => '数字+字母',
            '^[\w\-\.]+@[\w\-\.]+(\.\w+)+$' => 'E-mail',
            '^[0-9]{5,20}$' => 'QQ',
            '^http:\/\/' => '超级链接',
            '^(1)[0-9]{10}$' => '手机号码',
            '^[0-9-]{6,13}$' => '电话号码',
            '^[0-9]{6}$' => '邮政编码',			
			);
			
			return $array;
		}
		
		//检查并转换字段类型
		function check_fields($info)
		{
			
		}

		
}