<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'general';
$route['404_override'] = 'page_not_found/error404';
$route['translate_uri_dashes'] = TRUE;
$route['sign-up'] = 'users/sign-up';
$route['sign-up/(:any)'] = 'users/sign-up/$1';
$route['sign-up/(:any)/1'] = 'users/sign-up/$1/1';
$route['sign-in'] = 'users/sign-in';
$route['users'] = 'users/sign-in';
$route['sign-in/(:any)/(:any)'] = 'users/sign-in/$1/$2';
$route['sign-out'] = 'users/sign-out';
$route['fund'] = 'home/fund';
$route['fund-list'] = 'home/fund_list';
//$route['card'] = 'home/card';
$route['loan'] = 'home/loan';
$route['forex-plan'] = 'home/forex';
$route['crypto-plan'] = 'home/crypto';
$route['investment'] = 'home/investment';
$route['withdraw'] = 'home/withdraw';
$route['referrals'] = 'home/referrals';
$route['profile'] = 'home/profile';
$route['profile/(:any)'] = 'home/profile/$1';
$route['add-member'] = 'home/add_member';
$route['about'] = 'general/about';
$route['faq'] = 'general/faq';
$route['contacts'] = 'general/contacts';
$route['documentation'] = 'general/documentation';
$route['transaction-history-pane'] = 'ajax/transaction_history_pane';


// For Associates
$route['associate'] = 'associate/dashboard';