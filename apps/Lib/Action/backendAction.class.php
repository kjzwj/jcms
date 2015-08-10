<?php
/**
 * 后台控制器基类
 *
 * @author andery
 */
class backendAction extends baseAction
{
        protected $_name = '';
        public function _initialize() {
            parent::_initialize();

            if( session('entermodel')!='jcmsmanage' ){
                $this->_empty();
                exit();
            }
    				
    		// 检查登录
            $this->_check_admin();

            $this->_name = strtolower($this->getActionName());	//小写
    		$this->assign('action_name',$this->_name);
    		$this->assign('admin_menu',$this->adminMenu());
        }		
    		
		
		/**
		* 检查是否管理员登录
		*/
		protected function _check_admin()
		{
			$admin = C('admin_id');
			if (!admin_login() || !in_array(admin_login(),$admin)) {
				$this->error(L('please_login'),U('login/logout'));
                $this->redirect('login/logout');
				exit;
			}
		}
		
		
		//后台菜单
		protected function adminMenu($name='', $selected='')
		{
			$menu = array(
				'sysinfo'	=>	array(
					'title'	=>	'系统设置',
					'sonmenu'	=>	array(
						'index'	=>	'网站配置',
                        'email' =>  '邮箱配置',
                        'oauth' =>  '网站接入',
						// 'upload'	=>	'上传设置'
                        'admins/index' => '管理员',
					)
				),
                'admins'   =>  array(
                    'title' =>  '系统设置',
                    'status'    =>  'hide',
                    'sonmenu'   =>  array(
                        'sysinfo/index' =>  '网站配置',
                        'sysinfo/email' =>  '邮箱配置',
                        'sysinfo/oauth' =>  '网站接入',
                        // 'upload' =>  '上传设置'
                        'index' => '管理员',
                    )
                ),
				'category'	=>	array(
					'title'	=>	'内容管理',
					'sonmenu'	=>	array(
						'index'	=>	'栏目管理',
						'add'	=>	'添加栏目',
						'block/index'	=>	'静态块管理',
						'block/add'	=>	'添加静态块'
					)
				),
				'content'	=>	array(
					'title'	=>	'内容管理',
					'status'	=>	'hide',
					'sonmenu'	=>	array(
						'category/index'	=>	'栏目管理',
						'content/index?cat_id='.$_REQUEST['cat_id']	=>	'文章列表',
						'content/add?cat_id='.$_REQUEST['cat_id']	=>	'添加文章'
					)			
				),
				'block'	=>	array(
					'title'	=>	'内容管理',
					'status'	=>	'hide',
					'sonmenu'	=>	array(
						'category/index'	=>	'栏目管理',
						'category/add'	=>	'添加栏目',
						'index'	=>	'静态块管理',
						'add'	=>	'添加静态块'
					)
				),
				'model'	=>	array(
					'title'	=>	'模型设置',
					'sonmenu'	=>	array(
						'index'	=>	'模型列表',
						'add'	=>	'添加模型',
					)					
				),
				'model_fields'	=>	array(
					'title'	=>	'自定义字段',
					'status'	=>	'hide',
					'sonmenu'	=>	array(
						'diyform/index'	=>	'表单管理',
						'index?modelid='.$_REQUEST['modelid'].'&mtype='.$_REQUEST['mtype']	=>	'自定义字段',
						'add?modelid='.$_REQUEST['modelid'].'&mtype='.$_REQUEST['mtype']	=>	'添加字段'
					)					
				),
				'diyform'	=>	array(
					'title'	=>	'表单管理',
					'sonmenu'	=>	array(
						'index'	=>	'表单列表',
						'add'	=>	'添加表单',
					)					
				),
				'picshow'	=>	array(
					'title'	=>	'广告图片',
					'sonmenu'	=>	array(
						'index'	=>	'广告列表',
						'add'	=>	'添加广告',
					)					
				),
			);
			
			return $menu;
		}
		
    /**
     * 列表页面
     */
    public function index() {
        $map = $this->_search();
        $mod = D($this->_name);
        !empty($mod) && $this->_list($mod, $map);
				$this->assign('curr_name','index');
        $this->display();
    }
		
		
    /**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D($this->_name);
        $map = array();
        foreach ($mod->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_') {
                continue;
            }
            if ($this->_request($val)) {
                $map[$val] = $this->_request($val);
            }
        }
        return $map;
    }
		
		
    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
    {
        //排序
        $mod_pk = $model->getPk();
        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }
				//语言项目
				$map['lang'] = $this->lang;

        //如果需要分页
        if ($pagesize) {
            $count = $model->where($map)->count($mod_pk);
            $pager = new Page($count, $pagesize);
        }
        $select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->show();
        }
        $list = $select->select();
        $this->assign('list', $list);
        $this->assign('list_table', true);
    }

    /**
     * 添加
     */
    public function add() {
        $mod = D($this->_name);
				$this->assign('curr_name','add');
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
						if($this->lang != "" && !$data['lang']){
								$data['lang'] = $this->lang;
						}
            if( $mod->add($data) ){
                if( method_exists($this, '_after_insert')){
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }


    /**
     * 修改
     */
    public function edit()
    {
        $mod = D($this->_name);
	    //判断ID
		$id = $this->_request("id", 'intval');
		!$id && $this->error(L('_PARAM_ERROR_'));	
		
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }

            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }

            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $id = $this->_get($pk, 'intval');
			//语言项目
			$map['lang'] = $this->lang;
            $info = $mod->where($map)->find($id);
            $this->assign('info', $info);
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }								


    /**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        //AJAX修改数据
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $id = $this->_get($pk, 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array($pk=>$id))->setField($field, $val);
        $this->ajaxReturn(1);
    }

    /**
     * 删除
     */
    public function delete()
    {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        if ($ids) {
            if (false !== $mod->delete($ids)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }
    }
		
		
}
