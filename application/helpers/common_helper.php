<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------


/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */

if ( ! function_exists('getPageTitle'))
{
    function getPageTitle()
    {
        $CI =& get_instance();
        echo $CI->config->page_title;
        return $CI->config->page_title;
    }
}

/**
     * generateRandomString
     *
     * @access	public
     * @param	Integer
     * @return	string
     */
if ( ! function_exists('generateRandomString'))
{
    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}    
   
if ( ! function_exists('cutString'))
{
    function cutString($string='',$upto = 100,$strip_tags = TRUE,$title='' )
    {
                if($strip_tags)
                $string = strip_tags($string);
                
                if(strlen($string) > $upto)
                {
                        return substr($string,0, $upto).'<span  data-toggle="popover" title="'.$title.'" data-content="'.$string.'" data-placement="left">...</sapn>';
                    
                }
                else
                {
                    return $string;
                } 
    }
}



if ( ! function_exists('is_date'))
{
    function is_date($string='')
    {
        if(isset($string) && $string !=''  ){
                
            $stamp = strtotime( $string ); 
            
            if (!is_numeric($stamp) || !preg_match("^\d{1,2}[.-/]\d{2}[.-/]\d{4}^", $string)) {
                return FALSE; 
            }
            $month = date( 'm', $stamp ); 
            $day   = date( 'd', $stamp ); 
            $year  = date( 'Y', $stamp ); 

            if (checkdate($month, $day, $year)) 
                return TRUE; 

            return FALSE; 
        }
    }
}
    
    
if ( ! function_exists('is_selectedModule'))
{
    function is_selectedModule($menu = NULL)
    {
        if($menu){
            $selectedMenu = end((explode('/',$_SERVER['REQUEST_URI'])));
            if($menu == $selectedMenu){
           	return TRUE;
            }
            else{
           	 return FALSE;    
                }
        }
    }
}

if ( ! function_exists('getTempByZip'))
{
    function getTempByZip($zip = NULL)
    {
        if($zip){
            $jsonurl = "http://api.openweathermap.org/data/2.5/weather?zip=".$zip.",in";
            $json = file_get_contents($jsonurl);

            $weather = json_decode($json);
            $kelvin = $weather->main->temp;
            $celcius = $kelvin - 273.15;
            return $celcius;    
        }else{
            return FALSE;
        }
    }
}