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
$route['default_controller'] = 'Front'; 
$route['404_override'] = 'page_not_found';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] 		 		= 'admin/admin';
$route['admin/login'] 		 		= 'admin/admin';
$route['admin/logout'] 				= 'admin/admin/logout';
$route['admin/forgot_password'] 	= 'admin/admin/forgot_password';
$route['admin/reset_password'] 		= 'admin/admin/reset_password';

$route['admin/edit_profile'] 		= 'admin/admin/edit_profile';
$route['admin/change_password'] 	= 'admin/admin/change_password';

$route['admin/dashboard'] 			= 'admin/Dashboard';

$route['admin/subadmin/list'] 			= 'admin/admin/admin_list';
$route['admin/subadmin/list/:num'] 		= 'admin/admin/admin_list/:num';
$route['admin/subadmin/add'] 			= 'admin/admin/add_admin';
$route['admin/subadmin/edit/(:num)'] 	= 'admin/admin/edit_admin/$1';
$route['admin/subadmin/edit'] 			= 'admin/admin/edit_admin';

$route['admin/role_list'] 			= 'admin/admin/role_list';
$route['admin/role_list/:num'] 		= 'admin/admin/role_list/:num';
$route['admin/add_role'] 			= 'admin/admin/add_role';
$route['admin/edit_role/(:num)'] 	= 'admin/admin/edit_role/$1';
$route['admin/edit_role'] 			= 'admin/admin/edit_role';

$route['admin/business/list'] 			= 'admin/Business/user_list';
$route['admin/business/list/:num'] 		= 'admin/Business/user_list/:num';
$route['admin/business/add'] 			= 'admin/Business/add_user';
$route['admin/business/edit'] 	        = 'admin/Business/edit_user';
$route['admin/business/edit/(:num)'] 	= 'admin/Business/edit_user/$1';

$route['admin/user/list'] 			= 'admin/User/user_list';
$route['admin/user/list/:num'] 		= 'admin/User/user_list/:num';
$route['admin/user/add'] 			= 'admin/User/add_user';
$route['admin/user/edit'] 	        = 'admin/User/edit_user';
$route['admin/user/edit/(:num)'] 	= 'admin/User/edit_user/$1';

$route['admin/booking/list'] 			= 'admin/Booking/mlist';
$route['admin/booking/list/:num'] 		= 'admin/Booking/list/:num';
$route['admin/booking/detail/:num'] 	= 'admin/Booking/detail/:num';

$route['admin/not_authorized'] 	= 'admin/Admin/not_authorized';
$route['admin/prohibit_dashboard'] 	= 'admin/Dashboard/prohibit_dashboard';


$route['/'] 	= 'Front';
$route['more'] 	= 'Front/more';
$route['signup']= 'Front/signup';
$route['login']= 'Front/login';
$route['security_question']= 'Front/security_question';
$route['forgot_password']= 'Front/forgot_pass_step1';
$route['forgot_password/question']= 'Front/forgot_pass_step2';
$route['forgot_password/reset_pass']= 'Front/forgot_pass_step3';

$route['edit_profile']= 'Front/edit_profile';
$route['create_service']= 'Front/create_service';
$route['edit_service']= 'Front/edit_service';
$route['business_services']= 'Front/business_services';
$route['business_window']= 'Front/business_window';
$route['logout']= 'Front/business_logout';


$route['business_signup']= 'Front/business_signup';
$route['business_login']= 'Front/business_login';
$route['submit_question']= 'Front/submit_question';
$route['update_business_profile']= 'Front/update_business_profile';
$route['add_service']= 'Front/add_service';
$route['update_service']= 'Front/update_service';
$route['delete_service']= 'Front/delete_service';
$route['update_business_status']= 'Front/make_business_live';

$route['check_business_number']= 'Front/check_business_number';
$route['forgot_secury_verify']= 'Front/forgot_secury_verify';
$route['reset_password']= 'Front/reset_password';

$route['search']= 'Front/search_business';
$route['detail/:any']= 'Front/business_detail/$1';
$route['bqrcode']= 'Front/business_printqr';
$route['(:any)/services/:any']= 'Front/services/$1/$2';
$route['my_booking']= 'Front/my_booking';
$route['my_booking/(:any)']= 'Front/my_booking_data/$1';
$route['user_book_table']= 'Front/user_book_table';
$route['cancel_booking']= 'Front/cancel_booking';
$route['update_booking_status']= 'Front/update_booking_status';
$route['get_waiting_time']= 'Front/get_waiting_time';

$route['switch_lang/(:any)']= 'LanguageSwitcher/switchLang/$1';


$route['get-state']= 'Front/getState';
$route['get-city']= 'Front/getCity';
$route['share_app']= 'Front/share_app';
$route['how_it_work']= 'Front/how_it_work';
$route['privacy_policy']= 'Front/privacy_policy';
$route['about_us']= 'Front/about_us';