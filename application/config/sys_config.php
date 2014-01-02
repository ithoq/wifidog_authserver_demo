<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	自己定义的bug级别，快速调整所有调试的开关
 */
$config['MY_log_threshold'] = 'error';
/**
 * 是否验证wifidog的user-agent
 */
$config['MY_check_useragent'] = false;
/**
 *是否开启路由器本地认证
 */
$config['MY_local_auth'] = true;
/**
 *登录页面是否在路由器
 */
$config['MY_local_login'] = true;
/**
 * 是否开启路由器本地认证
 */
$config['MY_local_auth'] = false;
/**
 * 登录页面是否在路由器
 */
$config['MY_local_login'] = false;

/**
 * 是否验证移动客户端的useragent
 */
$config['MY_check_mobileagent'] = false;

