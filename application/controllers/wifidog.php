<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
    wifidog interface control classes
    To illustrate wifidog parameter passing mode, did not use the input parameter CI classes acquisition mode
*/
class Wifidog extends CI_Controller {
    private $is_mobile = false;
    private $valid_agent = true;
	
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        // Get the client user_agent limited future
        $temp_str = $this->input->user_agent() ;

        //if(!(!empty($temp_str) and $temp_str == 'WiFiDog 20131017'))
        //	$this->valid_agent = false;

        // http user_agent judgment based on the visitor's device type, mainly used in the login, and portal interfaces
        $this->is_mobile = isMobile();			
    }
    /**
     * Default Page
     */
    public function index()
    {
        // display a blank, or display a page to ordinary visitors
        echo "hello,wifidog!";
    }
	
    /**
     * Ping heartbeat connection processing interface, wifidog will follow the interval profiles, regular visits to this interface, in order to ensure the authentication server "alive"!
     */
    public function ping()
    {
        if(!$this->valid_agent)
            return;
        // url request "gw_id = $ gw_id & sys_uptime = $ sys_uptime & sys_memfree = $ sys_memfree & sys_load = $ sys_load & wifidog_uptime = $ wifidog_uptime";
        // log_message ($ this-> config-> Item ('MY_log_threshold'), __CLASS __ ':' .__ FUNCTION __ ':' debug_printarray ($ _ GET)...);

        // determine whether the various parameters is empty
        if( !(isset($_GET['gw_id']) and isset($_GET['sys_uptime']) and isset($_GET['sys_memfree']) and isset($_GET['sys_load']) and isset($_GET['wifidog_uptime']) ) )
        {
            echo '{"error":"2"}';
            return;
        }

        // add heartbeat log processing functions
        /*
        Here you can get the following parameters provided wififog
        1. gw_id  from wifidog configuration file, used to distinguish between different routing devices
        2. sys_uptime router system startup time
        3. sys_memfree percentage of system memory use
        4. wifidog_uptime wifidog uptime (this data is often a problem)
        */
    
        // return value
        echo 'Pong';
    }
    
    /**
     * Authentication user login page
     * This page is used to determine the user's identity in various ways (user name names, passwords, random code, microblogging, letter, qq, phone number, etc.)!
     * 
     * After the certification to do:
     * 1. authentication fails, or continue to return to this page (do not lose big to pass up the beginning wifidog parameters)
     * 2. Certification: According wifidog parameters do page redirects
     *
     * Currently the page using the most simple user name and password login
     */
    public function login()
    {	
        session_start();
        $this->form_validation->set_rules('username', 'Title', 'required');
        $this->form_validation->set_rules('password', 'text', 'required');
       
        /*
        Parameters wifidog brought over mainly
        1.gw_id
        2.gw_address wifidog Access address state
        3.gw_port 	 wifidog Access Port state
        4.url 	 redirected url (user access url)
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
    
            // server authentication page
            if($this->is_mobile)
                $this->load->view('model1/wifidog_login_mobile',$data);
            else
                $this->load->view('model1/wifidog_login_pc',$data);
        } else {
            // user login validation
            // authenticate the user, skip here, but check
            if(true)
            //if( $this->input->post('username') ==='ApFree' and $this->input->post('password') === 'apfree')
            {
                // successful login redirects to wifidog designated gw
                // comes with a randomly generated token parameter (md5), this only as a server client identification mark
                redirect('http://'.$_SESSION['gw_address'].':'.$_SESSION['gw_port'].'/wifidog/auth?token='.md5(uniqid(rand(), 1)).'&url='.$_SESSION['url'], 'location', 302);
            }else{
                // returns still unsuccessful login page
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
    * Certified Interface
    */
    public function auth()
    {
        if(!$this->valid_agent)
        return;
        // response timing authentication client can do all kinds of statistics, billing, etc. here
        /*
        wifidog will pass through this interface to connect the client information, 
        and then returned to the client to do the opening, disconnection and other treatment,
        the return value can be seen wifidog specific documents
        wifidog submit the following main parameters
        1. ip
        2. mac
        3. token (issued under the login page token)
        4. incoming download traffic
        5. outgoing upload traffic
        6. stage  certification stage, two kinds of login and counters
        */
        $stage = $_GET['stage'] == 'counters'?'counters':'login';
        if($stage == 'login')
        {
            // XXXX XXXX login skip processing stage can not just skip
            // default return allowed
            echo "Auth: 1";
        }
        else if($stage == 'counters')
        {
            // make a simple judgment verification flow, the flow value when downloading, offline notification is returned, otherwise stay online
            if(!empty($_GET['incoming']) and $_GET['incoming'] > 10000000)
            {
                echo "Auth: 0";
            } else {
                echo "Auth: 1\n";			
            }
        }
        else
           echo "Auth: 0"; // otherwise return refused
    
    
        /*
        Return Value: There are enough of these two
        0 - refused
        1 - Release
    
        The official document as follows
        0 - AUTH_DENIED - User firewall users are deleted and the user removed.
        6 - AUTH_VALIDATION_FAILED - User email validation timeout has occured and user/firewall is deleted (mail user authentication timeout, the firewall closes the user)
        1 - AUTH_ALLOWED - User was valid, add firewall rules if not present
        5 - AUTH_VALIDATION - Permit user access to email to get validation email under default rules(mail user authentication, users open email)
        -1 - AUTH_ERROR - An error occurred during the validation process
        */
    }

    /**
    * portal Jump interface
    */
    public function portal()
    {
        /*
        wifidog brought over the following parameters
        1. gw_id
        */

        // redirect to the specified website or display advertising splash page
        redirect('http://www.baidu.com', 'location', 302);
    }

    /**
     * wifidog of gw_message interface, information tips page
     *
     *------------------------------------------------------------------------------------
     * Note: Although this interface is seldom used, but there is a need to explain the problem under
     * Wifidog url to access the interface for /xxx/gw_message.php?message=XXX
     * This is the original wifidog the other four interface style is very inconsistencies, leading to the use of other non-php server issue
     * And if mining CI php framework, there are problems accessing on (other frameworks do not know)
     * Access to the interface can only be achieved through a special url redirection rules and other external configuration to
     *
     * apfree of wifidog client (apfree_wifidog_v2) will fix the problem, change it to /xxx/gw_message/?message=XXX format visit
     *------------------------------------------------------------------------------------
     */
    function gw_message()
    {
        if (isset($_REQUEST["message"])) {
            switch ($_REQUEST["message"]) {
                case 'failed_validation': 
                    // auth the stage for the login, the server returns when AUTH_VALIDATION_FAILED, came to where the handle
                    // authentication fails, please re-certification
                    break;                    
                case 'denied':
                    // auth the stage for the login, the server returns when AUTH_DENIED, came to where the handle
                    // denied certification
                    break;                    
                case 'activate': 
                    // auth the stage for the login, the server returns when AUTH_VALIDATION, came to where the handle
                    // to be activated
                    break;
                default:
                    break;
            }
        } else {
            // do not echo any information
        }
    }

}

/* End of file wifidog.php */
/* Location: ./application/controllers/wifidog.php */
