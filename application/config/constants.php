<?php

defined('BASEPATH') OR exit('No direct script access allowed');
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); 
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');





defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code








date_default_timezone_set('Asia/Kolkata');
define("panel", "admin");
define("creator", "creator");
define("vendor", "vendor");
define("user_app", "app/user/");




define("agora_appid", "b4a204158867474597eb34dfdbb8e49a");
define("agora_appcertificate", "a8bb309b0af04a0697a252ea7b0a868f");
define("customerKey", "a218f369c62b4f648ce47aa3d3f7cca4");
define("customerSecret", "92d8fa5afb89410eab4afa9dcce903a0");
define("agorachannel", "betbee");





if($_SERVER['HTTP_HOST']=='localhost'){
define("db_username","root");
define("db_password","");
define("db_name","betbee");
}
else{
define("db_username","u171934876_betbee");
define("db_password","Admin@123[];@@@");
define("db_name","u171934876_betbee");


// define("db_username","u314664796_betb");
// define("db_password","Admin@123[];@");
// define("db_name","u314664796_betb");
}






define("website_name", "BET BEE");
define("sort_name","BB");
define("copy_right","BET BEE");
define("copy_year","2024");
define("version","1.0");
define("trash",false);


define("captcha",false);
define("captcha_sitekey","");
define("captcha_secretekey","");


define("token_hours",48);
define("otp_hours",1);


define("feess", "5");
define("bet_fess", "0"); //percent
define("win_fess", "1"); // percent









