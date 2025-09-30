<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route[panel] = panel.'/Dashboard';
$route[panel.'/dashboard'] = panel.'/Dashboard';

$route['video/start_video'] = 'Video/start_video';





$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['test'] = 'Home/test';
$route['home/select_user'] = 'Home/select_user';



$route['app/user'] = 'Home/user_app';
$route['app/user/(:any)'] = 'Home/user_app/$1';


$base = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$base .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$url = explode($base, (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")[1];
$route['(:any)'] = 'Home/all/$1';
if(!empty(explode("/", $url)[0])&&explode("/", $url)[0]!='admin')
	$route['(:any)/(:any)'] = 'Home/all/$1/$2';
 