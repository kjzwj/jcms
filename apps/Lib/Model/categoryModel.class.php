<?php

class categoryModel extends Model {
	
		//自动验证
		protected $_validate = array(
			array('name','require','{%typename_require}'), 
			array('alias','require','{%alias_require}'),
			//array('modelid','require','{%model_require}'),
			array('template_index','require','{%template_index_require}'),
			//array('template_list','require','{%template_list_require}'),
			//array('template_show','require','{%template_show_require}'),
		);
		
		/*protected $_auto = array ( 
			array('template_index','index_default',3),
			array('template_list','list_default',3),
			array('template_show','show_default',3),
		);*/
		
    /**
     * 生成spid 
     * 
     * @param int $pid 父级ID
     */
    public function get_spid($pid) {
        if (!$pid) {
            return 0; 
        }
        $pspid = $this->where(array('id'=>$pid))->getField('spid');
        if ($pspid) {
            $spid = $pspid . $pid . '|';
        } else {
            $spid = $pid . '|';
        }
        return $spid;
    }		
		
    /**
     * 获取分类下面的所有子分类的ID集合
     * 
     * @param int $id
     * @param bool $with_self
     * @return array $array 
     */
    public function get_child_ids($id, $with_self=false) {
        $spid = $this->where(array('id'=>$id))->getField('spid');
        $spid = $spid ? $spid .= $id .'|' : $id .'|';
        $id_arr = $this->field('id')->where(array('spid'=>array('like', $spid.'%')))->select();
        $array = array();
        foreach ($id_arr as $val) {
            $array[] = $val['id'];
        }
        $with_self && $array[] = $id;
        return $array;
    }		
		
		/**
		 * 读取写入缓存(有层级的分类数据)
		*/
    public function cate_cache(){
			$cate_list = array();
			$cate_data = $this->field('id,pid,name,type,alias,modelid,seotitle,seokeywords,seodescription')->where(array('lang'=>$this->lang))->order('ordid desc,id asc')->select();
			//echo $this->getLastSql();
			foreach ($cate_data as $val) {
				//判断栏目类型
				switch($val['type']){
					case 1:
						$val['tname'] = '<span class="t1">'.L('type_page').'</span>';
						break;
					case 2:
						$val['tname'] = '<span class="t2">'.L('type_link').'</span>';
						break;
					default:
						$val['tname'] = '<span class="t0">'.L('type_list').'</span>';
				}
				
				if ($val['pid'] == '0') {
						$cate_list['p'][$val['id']] = $val;
				} else {
						$cate_list['s'][$val['pid']][$val['id']] = $val;
				}
			}
			F('cate_list', $cate_list);
			return $cate_list;
	}

	/**
	 * 取栏目信息(返回数组)
	 */
	public function get_info($cat_id,$top=0)
	{
		$cid = intval($cat_id);
		if($cid > 0)
		{
			$info = $this->find($cid);

			//取顶级名称
			if($top>0)
			{
				$top -= 1;
				$spid = $info['spid'];
				$id_arr = explode('|',$spid);
				$tid = $id_arr[$top];
				$info = $this->find($tid);
			}
			
		}
		
		return $info;
	}


	/*
	* 读取分类列表
	* @ $fields,$limit,$order 默认值
	* @ $catid 不会包括子栏目
	* @ $hasme 是否包括自己
	* @ $addend 添加到最后的栏目
	* @ lang 语言
	*/
	public function get_list($map=array(),$self=false,$addend=NULL)
	{
		$catid	= $map['catid']?$map['catid']:0;
		$addfields = $map['fields']?$map['fields']:'';
		$limit = $map['limit']?$map['limit']:20;
		$order = $map['order']?$map['order']:'ordid asc,id asc';

		$fields = 'id,name,alias,image,pid';
		if($addfields)
			$fields .= ','.$addfields;


		$where = array();
		$where['lang']	=	$this->lang;
		$where['pid'] = $catid;
		
		//图片
		if($map['image'])	$where['image'] = array('neq',"''");
		//导航
		if($map['isnav'])	$where['isnav'] = '1';

		$data = $this->field($fields)->where($where)->order($order)->limit($limit)->select();	//查询语句

		// 包括自己
		if( $self!=false ){
			$info[] = $this->field($fields)->find($catid);
			$data = array_merge($info,$data);
		}

		// 添加到最后的栏目
		if($addend){
			$addarr = $this->field($fields)->select($addend);
			$data = array_merge($data,$addarr);
		}

		// echo $this->getLastSql();

		return $data;
	}
	
}