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
$route['default_controller'] = 'home/index';
$route['404_override'] = '';
//$route["(.+)"]	= "home/getSlug/$1";
//$route['users/logout'] = 'home/logout';

    /* ////////////////////////////////////////////////////////////// 
     *                                                             *
     * @AUTHOR:   GORAKH NATH MEHTA (2020-2021)                    *
     *                                                             *
     * ////////////////////////////////////////////////////////////*/

$route['dashboard'] = 'admin_panel/dashboard';
$route['add_opd_patient'] = 'admin_panel/add_new_patient';
$route['edit_opd_patient/(:any)'] = 'admin_panel/edit_opd_patient/$1';
$route['upload_opd_patient_file'] = 'admin_panel/upload_opd_patient_file';
$route['opd_patient_list'] = 'admin_panel/opd_patient_list';
$route['add_surgery_patient_details'] = 'admin_panel/add_new_patient';
$route['surgery_patient_list'] = 'admin_panel/surgery_patient_list';
$route['download_patient_file/(:any)'] = 'admin_panel/download_patient_file/$1';
$route['download_parent_file/(:any)'] = 'admin_panel/download_parent_file/$1';
$route['download_referrer_file/(:any)'] = 'admin_panel/download_referrer_file/$1';
$route['download_patient_surgery_file/(:any)/(:num)'] = 'admin_panel/download_patient_surgery_file/$1/$2';
$route['download_hospital_surgery_file/(:any)'] = 'admin_panel/download_hospital_surgery_file/$1';
$route['edit_surgery_patient_details/(:any)'] = 'admin_panel/edit_surgery_patient_details/$1';
$route['advance_search'] = 'admin_panel/advance_search_surgery_patient';
$route['create_new_user_account'] = 'admin_panel/create_new_user_account';
$route['users_list'] = 'admin_panel/users_list';
$route['translate_uri_dashes'] = FALSE;

