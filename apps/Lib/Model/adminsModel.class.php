<?php

class adminsModel extends Model {
	
	//自动验证
	protected $_validate = array(
		array('username','','{%username_require}',0,'unique',3),
		array('password','require','{%password_require}'), 
		array('email','require','{%email_require}'), 
	);

    /**
     * 检测链接字段名是否存在
     *
     * @param string $name
     * @param int $pid
     * @return bool
     */
    function field_exists($field)
    {
		$pk = $this->getPk();
		$where = array();
		$where['username'] = $field;
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function add_user($data){
    	if(in_array('',$data)){
    		return array('status'=>0,'msg'=>'内容不完整');
    	}

    	// 再次检查是否重复
    	if($this->field_exists($data['username']))
    		return array('status'=>0,'msg'=>sprintf(L('is_exist'),L('username')));

    	// 处理密码
    	$data['salt'] = user_salt();
    	$data['password'] = user_md5($data['password'],$data['salt']);

    	if($this->add($data))
    		return array('status'=>1,'msg'=>L('operation_success'));
    }

}