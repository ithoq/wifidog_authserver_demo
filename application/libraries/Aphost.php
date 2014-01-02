<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
*   热点ap类
*/
class Aphost {
    //属性
    //状态
    public $user_cnt=0;
    public $max_user_cnt=10;
    //信息
    public $name='' ;       //名称
    public $type='';        //类型
    public $license='';     //序列号
    
    public $ip='';          //外网ip
    public $created_date='';//创建日期
    public $login_count=''; //登录次数
    public $last_rsync_date=''; //最后同步日期
    public $remark='';      //热点描述
    
    //内部私有变量
    private $ap_id;
    
    /**
     * 初始化函数，传递必要的参数
     */
    public function __construct($params)
    {
        // Do something with $params
        if(!empty($params['ap_id']))
            $this->ap_id = $params['ap_id'];        //ID为从数据库获取id的唯一途径
        if(!empty($params['license']))
            $this->$license = $params['license'];   //license为确认物理设备的唯一标志
    }
    
    /**
     * 创建新的ap （数据库操作）
     */
    public function create()
    {
        //主要做条件判断
        
        //数据库model 操作
    }
    
    /**
     * 删除ap
     */
    public function del($ap_id)
    {
        //条件判断
        
        //数据库model 操作
        
    }
    
    
    /**
     * 更新状态
     */
    public function update()
    {
        
    }
    
}