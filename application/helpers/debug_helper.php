<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('debug_printarray'))
{
    function debug_printarray($array = array())
    {
        $str = "array[\n";
        foreach( $array as $key=>$value)
        {
            $str .= "$key =>  ";
            if( is_array($value))
            {
                debug_printarray($value);
            }else{
                $str .=$value."\n";
            }
        }
        return $str."]\n";
    }
}


