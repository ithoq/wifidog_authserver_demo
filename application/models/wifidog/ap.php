<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ap_user extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
    // update the status of ap
    function update_ap($id,$gw_id,$sys_uptime,$sys_memfree,$sys_load,$wifidog_uptime)
    {
    
    }
	
    // Get the current state of ap
    function get_ap($id)
    {
    
    }
	
    // get the id according gw_id
    function getid_by_gwid($gw_id)
    {
        $query = $this->db->query("select id from wifi_ap where gw_id='$gw_id' ");
        if($query->num_rows()==1)
        {
            foreach ($query->result() as $row)
            {
                return $row->id;
            }
        } else if($query->num_rows()>1) {
            return -1;
        } else {
            return 0;
        }
    }
}
