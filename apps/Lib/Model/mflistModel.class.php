<?php

class MflistModel extends Model {

	/**
	 * 取模型的全部信息，按aid分组
	 * @modelid 模型id
	 * @mtype 1=内容模型，2=表单模型
	 */
	public function get_list($modelid,$mtype=1)
	{
		if(!$modelid) return false;
		
		//先全部取出
		$mflist = $this->where(array('modelid'=>$modelid,'mtype'=>$mtype,'lang'=>$this->lang))->select();

		//根据相同的一条信息aid重新分组
		$list = array();
		foreach($mflist as $v)
		{
			$list[$v['aid']][$v['fieldsid']] = $v;
		}

		return $list;
	}
	
	
	/**
	 * 取模型的一组信息
	 * @modelid 模型id
	 * @aid  文章id/组的id
	 * @mtype 1=内容模型，2=表单模型
	 */
	public function get_one($modelid, $aid, $mtype=1)
	{
		if(!$aid) return false;
		
		$fields = D('model_fields')->get_fields($modelid,array('mtype'=>$mtype));
		$mflist = $this->where(array('aid'=>$aid,'mtype'=>$mtype,'lang'=>$this->lang))->field()->select();
		
		//重新整成数组
		$list = array();
		foreach($mflist as $v)
		{
			$list[$v['fieldsid']]['id'] = $v['id'];
			$list[$v['fieldsid']]['fieldsid'] = $v['fieldsid'];
			$list[$v['fieldsid']]['modelid'] = $v['modelid'];
			$list[$v['fieldsid']]['name'] = $fields[$v['fieldsid']]['name'];
			$list[$v['fieldsid']]['info'] = $v['info'];
		}
		
		return $list;
	}
	
	
	
}