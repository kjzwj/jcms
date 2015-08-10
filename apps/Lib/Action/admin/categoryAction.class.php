<?php
class categoryAction extends backendAction {

	public function _initialize() {
			parent::_initialize();
			$this->_mod = D('category');
	}

 	public function index() {
			$sort = $this->_get("sort", 'trim', 'ordid');
			$order = $this->_get("order", 'trim', 'ASC');
			$tree = new Tree();
			$tree->icon = array('│ ','├─ ','└─ ');
			$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			$result = $this->_mod->where(array('lang'=>$this->lang))->order($sort,$order)->select();

			$array = array();
			foreach($result as $r) {
						$r['str_type'] = L('type_'.$r['type']);

						$r['str_manage'] = '<a href="'.U('home/content/index',array('cid'=>$r['id'])).'" target="_blank">'.L('lable_browse').'</a> |
					'.(($r['type']==0)?'<a href="'.U('content/index',array('cat_id'=>$r['id'])).'">'.L('tabs_content').'</a> | ':'').'
					<a href="'.U('category/add',array('pid'=>$r['id'])).'">'.L('lable_addsoncate').'</a> |
					<a href="'.U('category/edit',array('id'=>$r['id'])).'">'.L('lable_edit').'</a> |
					<a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="'.U('category/delete',array('id'=>$r['id'])).'" data-msg="'.sprintf(L('confirm_delete_one'),$r['name']).'分类下的文章也会删除">'.L('lable_del').'</a>';
$r['parentid_node'] = ($r['pid'])? ' class="child-of-node-'.$r['pid'].'"' : '';
            $array[] = $r;
        }
        $str  = "<tr id='node-\$id' \$parentid_node>
                <td class='text-c'>\$id</td>
								<td class='text-c'><span data-tdtype='edit' data-field='ordid' data-id='\$id' class='tdedit'>\$ordid</span></td>
                <td>\$spacer<span data-tdtype='edit' data-field='name' data-id='\$id' class='tdedit'>\$name</span></td>
								<td align='center' class='type_\$type'>\$str_type</td>
                <td class='text-c'>\$str_manage</td>
                </tr>";
			$tree->init($array);
			$list = $tree->get_tree(0, $str);
			$this->assign('curr_name','index');
			$this->assign('list', $list);
			$this->assign('list_table', true);
			$this->display();
	}
	
	public function _before_add(){
		
		//模型列表
		if (false === $model_list = F('model_list')) {
				$model_list = D('model')->model_cache();
		}

		$pid = $this->_get('pid','intval',0);
		if ($pid) {
			$pcate = $this->_mod->where(array('id'=>$pid))->find();
			$spid = $pcate['spid'];
			$spid = $spid ? $spid.$pid : $pid;
			$this->assign('spid', $spid);
		}
		
		$this->assign('parentid',$pid);
		$this->assign('pcate',$pcate);
		$this->assign('model_list',$model_list);
		$this->assign('iframe_tools',true);													//iFrame弹窗
	}
	
	function add_category(){
		$data = $this->_mod->create();
		if(!$data){
			$this->error($this->_mod->getError());
			exit();
		}else{

			$data['template_index'] = $data['template_index'] ? $data['template_index'] : 'index_default';
			$data['template_list'] = $data['template_list'] ? $data['template_list'] : 'list_default';
			$data['template_show'] = $data['template_show'] ? $data['template_show'] : 'show_default';
			$data['spid'] = $this->_mod->get_spid($data['pid']);
			
			if($data['type']>0){
				$data['modelid']=0;
			}

			if (false !== $this->_mod->add($data)) {
				$this->success(L('_OPERATION_SUCCESS_'),U('category/index'));
			}else{
				$this->error($this->_mod->getError());
			}
			F('cate_list',NULL);	//清除缓存
		}
	}
	
	public function get_model_files(){
			$id = $this->_get('id','intval',0);
			if($id>0){
				$data = M('model')->field('tablename, template_index,template_list,template_show')->find($id);
				$this->ajaxReturn(1,'ok',$data);
			}
			$this->ajaxReturn(0,'error');
	}
	
	//分类列表
	private function cate_list(){
		if (false === $cate_list = F('cate_list')) {
				$cate_list = $this->_mod->cate_cache();
		}
		$this->assign('cate_list',$cate_list);
	}
	
	//编辑
	function _before_edit(){

		//模型列表
		if (false === $model_list = F('model_list')) {
				$model_list = D('model')->model_cache();
		}
		
		$this->assign('model_list',$model_list);		
		$this->assign('iframe_tools',true);		//iFrame弹窗
	}
	
	function _before_update($data = ''){
		$cate = $this->_mod->field('img,pid')->where(array('id'=>$data['id']))->find();
		if ($data['pid'] != $cate['pid']) {
				//不能把自己放到自己或者自己的子目录们下面
				$wp_spid_arr = $this->_mod->get_child_ids($data['id'], true);
				if (in_array($data['pid'], $wp_spid_arr)) {
						$this->error(L('cannot_move_to_child'));
				}
				//重新生成spid
				$data['spid'] = $this->_mod->get_spid($data['pid']);
		}
		
		$data['template_index'] = $this->_post('template_index') ? $this->_post('template_index') : 'index_default';
		$data['template_list'] = $this->_post('template_list') ? $this->_post('template_list') : 'list_default';
		$data['template_show'] = $this->_post('template_show') ? $this->_post('template_show') : 'show_default';
					
		F('cate_list',NULL);	//清除缓存
		
		return $data;
	}
	
	
	/**
	 * ajax获取分类
	 */
	public function ajax_getchilds() {
			$id = $this->_get('id', 'intval');
			$type = $this->_get('type', 'intval', NULL);
			$modelid = $this->_get('modelid', 'intval', NULL);
			$map = array('pid'=>$id,'lang'=>$this->lang);
			if (!is_null($type)) {
					$map['type'] = $type;
			}
			if (!is_null($modelid)) {
					$map['modelid'] = $modelid;
			}
			$return = $this->_mod->field('id,name')->where($map)->select();
			if ($return) {
					$this->ajaxReturn(1, L('operation_success'), $return);
			} else {
					$this->ajaxReturn(0, L('operation_failure'));
			}
	}
	

	/*
	* 删除分类
	* 删除子分类
	* 删除分类下的文章
	*/
	public function delete(){
		$ids = trim($this->_request('id'), ',');

		$this->_content = D('content');

		$id_arr = explode(',', $ids);
		$complete = false;
		$aid_arr = array();
		foreach ($id_arr as $id) {
			$child_ids = $this->_mod->get_child_ids($id,true);
			if(count($child_ids>0)){
				$aids = $this->_content->where(array('cat_id'=>array('in',$child_ids)))->field('id')->select();
				foreach ($aids as $aid) {
					$aid_arr[] = $aid['id'];
				}
				$this->_content->related_delete($aid_arr);	//删除文章
			}
			$this->_mod->where(array('id'=>array('in',$child_ids)))->delete();	//删除分类
			// echo $this->_mod->getLastSql();

			$complete = true;
		}

		if (false !== $complete) {
			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
			$this->success(L('operation_success'));
		} else {
			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
			$this->error(L('operation_failure'));
		}

	}



}