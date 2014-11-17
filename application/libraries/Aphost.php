<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
* Host AP Classes
*/
class Aphost {
    // property
    // status
    public $user_cnt=0;
    public $max_user_cnt=10;
    // Information
    public $name='' ;           // name
    public $type='';            // type
    public $license='';         // serial number
    
    public $ip='';              // external network ip
    public $created_date='';    // Created Date
    public $login_count='';     // logins
    public $last_rsync_date=''; // last synchronization date
    public $remark='';          // hotspot description
    
    // internal private variables
    private $ap_id;
    
    /**
     * Initialization function, passing the necessary parameters
     */
    public function __construct($params)
    {
        // Do something with $params
        if(!empty($params['ap_id']))
            $this->ap_id = $params['ap_id'];        // ID is the only way to get the id from the database
        if(!empty($params['license']))
            $this->$license = $params['license'];   // license for confirmation only sign of physical devices
    }
    
    /**
     * Create a new ap (database operations)
     */
    public function create()
    {
        // main job conditional
        // database model operation
    }
    
    /**
     * Delete AP
     */
    public function del($ap_id)
    {
        // conditional
        // database model operation
    }
    
    
    /**
     * Update Status
     */
    public function update()
    {
        
    }
}
