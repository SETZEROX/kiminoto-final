<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['sign-in'] = 'Page/signin';
$route['download'] = 'Page/download';
$route['logout'] = 'Page/logout';
$route['admin'] = 'Page/signin_admin';
$route['invse_cars'] = 'Page/invse_cars';
$route['invse_all'] = 'Page/invse_all';
$route['rule_server'] = 'Page/rule_server';

$route['redeem'] = 'Member/redeem';
$route['store'] = 'Member/store';
$route['topup/wallet'] = 'Member/topup/wallet';
$route['topup/banking'] = 'Member/topup/banking';
$route['redeem/process'] = 'Member/redeem_process';
$route['Backend/redeem/update-redeem'] ='Backend/update_redeem';
$route['Backend/redeem/delete-redeem'] ='Backend/delete_redeem/';

$route["backend/sign-in"] = 'Page/bk_checker';
