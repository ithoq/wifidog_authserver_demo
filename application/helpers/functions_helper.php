<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('isMobile'))
{
    function isMobile() {
        if(isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        if(isset ($_SERVER['HTTP_VIA'])) {
            // can not be found for false, otherwise true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            // This array needs to be improved
            $clientkeywords = array (
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            );
            // Find the phone browser HTTP_USER_AGENT keywords
            if(preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
     
        // Agreements Act, because there may not be accurate, put the final judgment
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // If you support only and does not support html wml it must be mobile devices
            // If the support wml wml and html but before the html is a mobile device
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
         
        return false;
    }    
}
