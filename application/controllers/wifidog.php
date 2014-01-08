<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
	wifidog 接口控制类
	
	为了说明wifidog参数传递方式，没有采用CI的input类的参数获取方式
	
 */
class Wifidog extends CI_Controller {
    private $is_mobile = false;
	private $valid_agent = true;
	
    /**
     * 构造函数
     */
	function __construct()
	{
		parent::__construct();
		//获取user_agent将来对客户端进行限定		
		$temp_str = $this->input->user_agent() ;
		
		
		//if(!(!empty($temp_str) and $temp_str == 'WiFiDog 20131017'))
		//	$this->valid_agent = false;
        
		//根据 http user_agent 判断访问者的设备类型，主要用在login，及portal接口上
		$this->is_mobile = isMobile();			
	}
	/**
     * 默认页面
     */
	public function index()
	{
		//显示空白，或者显示给普通访问者的页面
		echo "hello,wifidog!";
	}
	
	/**
     * ping心跳连接处理接口，wifidog会按照配置文件的间隔时间，定期访问这个接口，以确保认证服务器“健在”！
     */
	public function ping()
	{
		if(!$this->valid_agent)
			return;
		//url请求 "gw_id=$gw_id&sys_uptime=$sys_uptime&sys_memfree=$sys_memfree&sys_load=$sys_load&wifidog_uptime=$wifidog_uptime";
		//log_message($this->config->item('MY_log_threshold'), __CLASS__.':'.__FUNCTION__.':'.debug_printarray($_GET));
		
		//判断各种参数是否为空
		if( !(isset($_GET['gw_id']) and isset($_GET['sys_uptime']) and isset($_GET['sys_memfree']) and isset($_GET['sys_load']) and isset($_GET['wifidog_uptime']) ) )
		{
			echo '{"error":"2"}';
			return;
		}
		//添加心跳日志处理功能
		/*
		此处可获取 wififog提供的 如下参数
		1.gw_id  来自wifidog 配置文件中，用来区分不同的路由设备
		2.sys_uptime 路由器的系统启动时间
		3.sys_memfree 系统内存使用百分比
		4.wifidog_uptime wifidog持续运行时间（这个数据经常会有问题）		
		*/
		
		//返回值
		echo 'Pong';
	}
	
	/**
     * 认证用户登录页面
	 * 该页面用来用各种方式（用户名名、密码，随机码，微博，微信，qq，手机号码等）判定使用者的身份！
	 * 
	 * 认证后要做的事情：	1.认证不通过，还是继续回到该页面（大不要丢掉刚开始wifidog传递上来的参数）
	 *						2.通过认证：根据wifidog的参数，做页面重定向						
	 *
	 * 目前该页面采用了最简单的用户名、密码登录方式
     */
	public function login()
	{	
		session_start();
		$this->form_validation->set_rules('username', 'Title', 'required');
		$this->form_validation->set_rules('password', 'text', 'required');
        
		/*
		wifidog 带过来的参数主要有
		1.gw_id
		2.gw_address wifidog状态的访问地址
		3.gw_port 	wifidog状态的访问端口
		4.url 		被重定向的url（用户访问的url）
		
		*/	
		
		if ($this->form_validation->run() === FALSE)
		{
			
			if(!empty($_GET))
			{
				
				$data['gw_address'] = $_GET['gw_address'];
				$data['gw_port'] = $_GET['gw_port'];
				$data['gw_id'] = $_GET['gw_id'];
				$data['url'] = $_GET['url'];				
				$_SESSION['url'] = $_GET['url'];
				$_SESSION['gw_port'] = $_GET['gw_port'];
				$_SESSION['gw_address'] = $_GET['gw_address'];
				
			}else{
				$data['gw_address'] = '';
				$data['gw_port'] = '';
				$data['gw_id'] = '';
				$data['url'] = '';	
			}
			$data['form_url'] = base_url('wifidog/login');
			           
			//服务器验证页面
			if($this->is_mobile)
				$this->load->view('model1/wifidog_login_mobile',$data);
			else
				$this->load->view('model1/wifidog_login_pc',$data);
       	}
		else
		{
			//用户登录校验		
			
			//认证用户，此处直接跳过，不过校验
			if(true)
			//if( $this->input->post('username') ==='ApFree' and $this->input->post('password') === 'apfree')
			{
				//登录成功重定向到wifidog指定的gw
				//附带一个随机生成的token参数（md5），这个作为服务器认定客户的唯一标记
				redirect('http://'.$_SESSION['gw_address'].':'.$_SESSION['gw_port'].'/wifidog/auth?token='.md5(uniqid(rand(), 1)).'&url='.$_SESSION['url'], 'location', 302);
			}else{
				//不成功仍旧返回登录页面
				$data[$debug] = '登录失败';
                if($this->is_mobile)
                    //$this->load->view('model1/wifidog_login_mobile',$data);
					$this->load->view('model1/wifidog_login_mobile',$data);
                else
                    $this->load->view('model1/wifidog_login_pc',$data);
			}
		}
	}	
	/**
     * 认证接口
     */
	public function auth()
	{
		if(!$this->valid_agent)
			return;
		//响应客户端的定时认证，可在此处做各种统计、计费等等
		/*
		wifidog 会通过这个接口传递连接客户端的信息，然后根据返回，对客户端做开通、断开等处理，具体返回值可以看wifidog的文档
		wifidog主要提交如下参数
		1.ip
		2. mac
		3. token（login页面下发的token）
		4.incoming 下载流量
		5.outgoing 上传流量 
		6.stage  认证阶段，就两种 login 和 counters
		*/
		//做一个简单的流量判断验证，下载流量超值时，返回下线通知，否则保持在线
		if(!empty($_GET['incoming']) and $_GET['incoming'] > 10000000)
		{
			echo "Auth: 0";
		}else{
			echo "Auth: 1\n";			
		}
		/*
		返回值：主要有这两种就够了
		0 - 拒绝
		1 - 放行
		
		官方文档如下
		0 - AUTH_DENIED - User firewall users are deleted and the user removed.
		6 - AUTH_VALIDATION_FAILED - User email validation timeout has occured and user/firewall is deleted（用户邮件验证超时，防火墙关闭该用户）
		1 - AUTH_ALLOWED - User was valid, add firewall rules if not present
		5 - AUTH_VALIDATION - Permit user access to email to get validation email under default rules （用户邮件验证时，向用户开放email）
		-1 - AUTH_ERROR - An error occurred during the validation process
		*/
	}
	/**
     * portal 跳转接口
     */
	public function portal()
	{
		/*
			wifidog 带过来的参数 如下
			1. gw_id
		*/
		
		//重定到指定网站 或者 显示splash广告页面		
		redirect('http://www.baidu.com', 'location', 302);
			
	}
    
    
    /**
     * wifidog 的gw_message 接口，信息提示页面
     */
    function gw_message()
    {
        if (isset($_REQUEST["message"])) {
            switch ($_REQUEST["message"]) {
                case 'failed_validation': 
				//auth的stage为login时，被服务器返回AUTH_VALIDATION_FAILED时，来到该处处理
				//认证失败，请重新认证                    
                    break;                    
                case 'denied':
				//auth的stage为login时，被服务器返回AUTH_DENIED时，来到该处处理
				//认证被拒
                    break;                    
                case 'activate': 
				//auth的stage为login时，被服务器返回AUTH_VALIDATION时，来到该处处理
				//待激活
                    break;
                default:
                    break;
            }
        }else{
            //不回显任何信息
        }
    }
}

/* End of file wifidog.php */
/* Location: ./application/controllers/wifidog.php */