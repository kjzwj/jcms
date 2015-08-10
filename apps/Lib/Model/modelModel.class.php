<?php

class modelModel extends Model {
	
		//自动验证
		protected $_validate = array(
			array('name','require','{%name_require}'), //默认情况下用正则进行验证
			array('tablename','require','{%tablename_require}'),
			array('tablename','','数据库表已经存在',0,'unique',3),
		);
	
		//自动完成
		protected $_auto = array ( 
				array('template_index','index_default.tpl',3),  // 默认主页模板
				array('template_list','list_default.tpl',3) , // 默认列表模板
				array('template_show','show_default.tpl',3), // 默认详细模板
		);
			
		/**
		 * 读取写入缓存
		 */
    public function model_cache(){
			$model_list = array();
			$model_data = $this->where(array('show'=>'1'))->select();
			foreach ($model_data as $val) {
					$val['index_template'] = $val['index_template'] ? $val['index_template'] : 'index_'.$val['tablename'].C('TMPL_TEMPLATE_SUFFIX');
					$val['list_template'] = $val['list_template'] ? $val['list_template'] : 'list_'.$val['tablename'].C('TMPL_TEMPLATE_SUFFIX');
					$val['show_template'] = $val['show_template'] ? $val['show_template'] : 'show_'.$val['tablename'].C('TMPL_TEMPLATE_SUFFIX');
				
				$model_list[$val['id']] = $val;
			}
			
			F('model_list', $model_list);
			return $model_list;
	}
	
    /**
     * 检测链接名称是否存在
     *
     * @param string $name
     * @param int $pid
     * @return bool
     */
    public function name_exists($name, $id=0, $field='name')
    {
        $pk = $this->getPk();
        $where = $field."='" . $name . "'  AND ". $pk ."<>'" . $id . "'";
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }	
}