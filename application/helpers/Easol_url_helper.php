<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function current_url_full()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}


function strip_accents($string)
{
	return strtr($string, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function slug($url) 
{
	$url = strtolower(str_replace(array(" ", "&"), array("-", "-and-"), $url));
	$url = str_replace(array("(", ")", ".", "@", "#", "$", "%", "¨", "*", "{", "[", "}", "]", "\"", "'", "=", "+", "§", "ª", "º", ",", "/", "\\", "~", "^"), "", $url);
	$url = str_replace("--", "-", str_replace("--", "-", $url));
	
	$url = strip_accents($url);
	$url = urlencode(preg_replace("/[^A-Za-z0-9\-]/", "", $url));
	
	return $url;
}
