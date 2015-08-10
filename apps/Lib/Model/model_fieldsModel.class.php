<?php

class model_fieldsModel extends Model {
	
		//自动验证
		protected $_validate = array(
			array('formtype','require','请选择字段类型'), //默认情况下用正则进行验证
			array('name','require','字段别名不能为空'), //默认情况下用正则进行验证
		);

    /**
     * 检测链接字段名是否存在
     *
     * @param string $name
     * @param int $pid
     * @return bool
     */
    public function field_exists($field, $modelid,$mtype=1)
    {
				$pk = $this->getPk();
				$where = array();
				$where['field'] = $field;
				$where['modelid'] = $modelid;
				$where['mtype'] = $mtype;
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
		
		
		//根据模型ID取附加字段 return array
		function get_fields($modelid,$where=array())
		{
			$map['mtype'] = 1;
			$map['isshow'] = 1;
			$map['lang'] = $this->lang;
			$map = array_merge($map,$where);
			$map['modelid'] = $modelid;
			$fields = $this->where($map)->select();
			$array_fields = array();
			foreach($fields as $k=>$v){
				$array_fields[$v['id']] = $v;
			}
			return $array_fields;
		}


		// 取字段名，返回字符串
		function get_field($id){
			$field = $this->where('id='.$id)->getField('field');
			return $field;
		}
		
		
		//自定义字段输出为 input 控件
		function fields_input($fields,$is_edit=0,$mtype=1)
		{
				if(is_array($fields))
				{
					$html = new Html();
					$fields_input = array();
					foreach($fields as $key=>$val)
					{
						$attribute = '';
						$selected = '';
						$value = $val['defvalue'];
						/*
						if(!empty($val['verification']))
						{
							$attribute .= ' pattern="'.$val['verification'].'" ';
						}
						*/
						if($val['required']==1)
						{
							$attribute .= ' required="required" ';
						}
						//编辑时处理值 value
						if($is_edit>0)
						{
							$value = M('mflist')->where(array('aid'=>$is_edit,'fieldsid'=>$val['id'],'mtype'=>$mtype,'lang'=>$this->lang))->getField('info');
							//图片集
							if($val['formtype'] == 'images' && $value){
								$img_arr = explode('|||',trim($value,'|||'));
								$value = array_chunk($img_arr,2);
								$imglist['images_'.$val['id']] = $value;
								$fields_input['imglist'] = $imglist;
							}
							
						}
						if($val['formtype']=='select' || $val['formtype']=='radio' || $val['formtype']=='checkbox')
						{
								$selected = $value;
								$value = $val['defvalue'];
						}
						$val['input'] = $html->input($val['formtype'],'addfields['.$val['id'].']',$value,$val['field'],$attribute,$selected);
						$fields_input[$val['id']] = $val;
					}// end foreach
				}//end if
				
				return $fields_input;
		}
			
			
		//储存附加字段
		function save_fields($aid,$data=array(),$mtype=1)
		{
			//验证限制格式
			if($data['verification']){
				if(!preg_match("/{$data['verification']}/",$data['info'])){
					return false;
					exit;
				}
			}//验证限制格式
						
			$mflist = D('mflist');
			if($aid && $data['fieldsid']){
				$data['fieldsid'] = str_replace('images_','',$data['fieldsid']);
				$id = $mflist->where(array('aid'=>$aid,'fieldsid'=>$data['fieldsid'],'mtype'=>$mtype))->getField('id'); 
				if($id)	//存在则更新
				{
					$where = array();
					$where['id'] = $id;
					$where['aid'] = $aid;
					$where['fieldsid'] = $data['fieldsid'];
					$where['mtype'] = $mtype;	//内容模型
					$data['modelid']>0 && $where['modelid']=$data['modelid'];
					$mflist->where($where)->setField(array('info'=>$data['info']));
				}else{	//否则添加
					$cdata = array(
						'aid'				=>	$aid,
						'fieldsid'	=>	$data['fieldsid'],
						'modelid'		=>	$data['modelid'],
						'info'			=>	$data['info'],
						'mtype'			=>	$mtype,
						'lang'			=>	$this->lang
					);
					$mflist->add($cdata);
				}//endif 2
			}//endif 1
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
            '^([A-Za-z0-9-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([A-Za-z0-9-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$' => 'E-mail',
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