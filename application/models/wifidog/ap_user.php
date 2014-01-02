<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    

	
class Ap_user extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	//验证用户名密码验证的是否可以登录，true可以登录，false不允许登录
	//@$ap_id :ap的id（名称）
	//@user_name:用户名
	//@user_password:密码
	function checkuser($ap_id,$user_name,$user_password)
	{
		//校验
		
		//查询
		$query = $this->db->query("select * from ap_user a ,wifi_ap b where  a.username='$user_name' and a.password='$user_password' and  b.gw_id='$ap_id' and a.ap_id=b.id  ");
		if($query->num_rows()===1)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	//验证用户是否存在
	function isuser()
	{
		
	}
	
	//添加用户
	//@$ap_id :ap的id（名称）
	//@user_name:用户名
	//@user_password:密码
	function adduser($ap_id,$user_name,$user_password)
	{
		//验证用户是否存在
	}
	//删除用户
	//@$ap_id :ap的id（名称）
	//@user_name:用户名
	//@user_password:密码
	function deluser($ap_id,$user_name,$user_password)
	{
		
	}
	
	//修改用户密码
	//@$ap_id :ap的id（名称）
	//@user_name:用户名
	//@user_password:密码
	function changepassword($ap_id,$user_name,$user_password)
	{
				
	}
	
	
	//查询用户上网类型
	
	
	
	//内部函数，通过ap的id（字符串），获取到ap的id号
	//@$ap_id ap_id  
	//正确的话 返回id，错误返回负值
	function __getid_by_apid($ap_id)
	{
		$query = $this->db->query("select id from wifi_ap  where  gw_id='$ap_id' ");
		if($query->num_rows()==1)
		{
			 foreach ($query->result() as $row)
			 {
			 	return $row->id;
			 }
		}else if($query->num_rows()>1){
			return -1;
		}else{
			return 0;
		}
	}
	
}

	