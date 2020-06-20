<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'wallet';
$route['404_override'] = 'error404';
$route['translate_uri_dashes'] = FALSE;




$route['login']='wallet/login';
$route['logout']="wallet/logout";
$route['dashboard']="wallet/dashboard";
$route['profile']="wallet/profile";
$route['update-profile']="wallet/update_profile";
$route['update-password']="wallet/update_password";


$route['wallet']="wallet/wallet";
