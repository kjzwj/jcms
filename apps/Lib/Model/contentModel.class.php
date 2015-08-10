<?php

class contentModel extends Model {

	/**
	 * 取栏目信息(返回数组)
	 */
	public function get_flag($name='')
	{
		$flag = array(
			'r' => L('flag_r'),	//推荐
			't' => L('flag_t'),	//置顶
			'p' => L('flag_p')	//图片
		);
		
		if(!empty($name)){
			return $flag[$name];
		}
		
		return $flag;
	}
	
	
	//临时的会员权限
	function get_access_temp($name='')
	{
		$access = array(
			'1' => '开放浏览',
			'2' => '注册会员',
			'3' => '高级会员',
			'4' => '只限管理员'
		);
		
		if(!empty($name)){
			return $access[$name];
		}
		return $access;
	}
	
	
	/*
	* 读取文章列表
	* @ $fields,$limit,$order 默认值
	* @ $catid 会包括子栏目
	* @ lang 语言
	*/
	public function get_list($map=array())
	{
			$addfields = trim($map['fields']);
			$limit = $map['limit']?$map['limit']:20;
			$order = $map['order']?$map['order']:'ordid desc,id desc';
			
			$where = array();
			$where['status']	=	1;
			$where['lang']	=	$this->lang;
			
			//文章属性
			if($map['flag'])	$where['flag'] = array('like','%'.$map['flag'].'%');
			//图片
			if($map['image'])	$where['image'] = array('neq',"''");
			// 关键字
			if($map['keyword']) $where['title'] = array('like','%'.$map['keyword'].'%');
	
			//文章所在分类
			$catid = $map['catid'];
			$ids = explode(',',$catid);
			$catids = array();
			foreach($ids as $k=>$cid)
			{
				$arr = D('category')->get_child_ids($cid,true);
				$catids = array_merge($catids,$arr);
			}
			if($catids)
				$where['cat_id'] = array('in',$catids);
					
			//如果需要分页
			$pagesize = $map['pagesize'];

			if ($pagesize) {
					$count = $this->where($where)->count();
					if( C('URL_ROUTER_ON')===true ){
						$pager = new Page($count, $pagesize,'','category/'.$catid.'-');
					}else{
						$pager = new Page($count, $pagesize);
					}
			}
			$data['_total'] = $count;
			$select = $this->where($where)->order($order);	//查询语句
			if ($pagesize) {
					$select->limit($pager->firstRow.','.$pager->listRows);
					$page = $pager->show();
					$data['_page'] = $page;
			}else{
					$select->limit($limit);
			}
			
			$list = $select->select();

			//附加字段
			if($addfields)
			{
				foreach ($list as $aid=>$arc) {
					$fields = D('model_fields')->get_fields($arc['modelid'],array('field'=>array('in',$addfields)));
					foreach ($fields as $val) {
						$mflist = D('mflist')->get_one($arc['modelid'],$arc['id']);
						$list[$aid][$val['field']]=$mflist[$val['id']]['info'];
					}
				}
			}
			$data['list'] = $list;
			//echo $this->getLastSql();
			return $data;
	}


	/* 取单编文章
	* @ $id 文章ID 必须
	* @ $addfields 是否查询附加表字段
	*/
	public function get_info($id,$addfields = true)
	{
		$info = $this->find($id);


		// 附加字段
		$mflist = $addinfo = array();
		if($addfields)
		{
			$mflist = M('mflist')->where('aid='.$id)->select();

			if($mflist){
				foreach ($mflist as $key=>$val) {
					$field = D('model_fields')->get_field($val['fieldsid']);
					$addinfo[$field] = $val['info'];
				}
			}
		}

		$data = array_merge($info,$addinfo);
		return $data;
	}
	

	/*
	* 删除文章
	* 删除相关字段
	*/
	public function related_delete($ids){
		// if(is_array($ids))	$id = join(',',$ids);
		if(false !== $this->where(array('id'=>array('in',$ids)))->delete()){
			M('mflist')->where(array('aid'=>array('IN',$ids),'mtype'=>1))->delete();		//删除相关字段
			return true;
		}
		return false;
	}
	

	
}
