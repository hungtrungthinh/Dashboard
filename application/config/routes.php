<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "admin/login";
$route['404_override'] = '';
$route['admin'] = 'admin/login';
$route['admin/restaurant'] = 'admin/restaurant/lists';
$route['admin/restaurant/index'] = 'admin/restaurant/lists';

$route['chef/orders'] = 'admin/orders';
$route['chef/orders/(:any)'] = 'admin/orders/$1';
$route['chef/menu'] = 'admin/menu';
$route['chef/menu/(:any)'] = 'admin/menu/$1';
$route['chef/home'] = 'admin/home';
$route['chef'] = 'admin/login';
$route['chef/profile'] = 'admin/profile'; 
$route['chef/profile/(:any)'] = 'admin/profile/$1'; 

$route['manager'] = 'admin/login';
$route['manager/home'] = 'admin/home';
$route['manager/orders'] = 'admin/orders';
$route['manager/orders/(:any)'] = 'admin/orders/$1';
$route['manager/reports'] = 'admin/reports';
$route['manager/reports/(:any)'] = 'admin/reports/$1';
$route['manager/customers'] = 'admin/customers';
$route['manager/customers/(:any)'] = 'admin/customers/$1';
$route['manager/location'] = 'admin/location';
$route['manager/location/(:any)'] = 'admin/location/$1';
$route['manager/profile'] = 'admin/profile';
$route['manager/promocodes'] = 'admin/promocodes';
$route['manager/promocodes/(:any)'] = 'admin/promocodes/$1';
$route['manager/notification'] = 'admin/notification';
$route['manager/notification/(:any)'] = 'admin/notification/$1';


$route['chef/preference/(:any)'] = 'admin/preference/$1';
$route['manager/preference/(:any)'] = 'admin/preference/$1';
$route['chef/preference'] = 'admin/preference';
$route['manager/preference'] = 'admin/preference';

/* End of file routes.php */
/* Location: ./application/config/routes.php */