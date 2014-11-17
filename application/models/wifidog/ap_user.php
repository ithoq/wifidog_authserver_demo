<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ap_user extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
    // verify user name and password to verify whether you can log in, true can log, false does not allow login
    // @$ap_id:        AP's id (name)
    // @user_name:     Username
    // @user_password: Password
    function checkuser($ap_id,$user_name,$user_password)
    {
        // check
    
        // query
        $query = $this->db->query("select * from ap_user a, wifi_ap b where a.username='$user_name' and a.password='$user_password' and b.gw_id='$ap_id' and a.ap_id=b.id  ");
        if($query->num_rows()===1)
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    // verify that the user exists
    function isuser()
    {
    
    }
    
    // Add User
    // @$ap_id:        AP's id (name)
    // @user_name:     Username
    // @user_password: Password
    function adduser($ap_id,$user_name,$user_password)
    {
        // verify that the user exists
    }

    // Delete User
    // @$ap_id:        AP's id (name)
    // @user_name:     Username
    // @user_password: Passoword
    function deluser($ap_id,$user_name,$user_password)
    {
    
    }
    
    // Modify User Password
    //@$ap_id:        AP's id (name)
    //@user_name:     Username
    //@user_password: Password
    function changepassword($ap_id,$user_name,$user_password)
    {
    
    }
    
    // query the user access type

    // internal functions, by ap's id (string), access to ap id number
    // @$ap_id AP's id (name)
    // returns the correct id, an error is returned negative
    function __getid_by_apid($ap_id)
    {
        $query = $this->db->query("select id from wifi_ap where gw_id='$ap_id' ");
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
