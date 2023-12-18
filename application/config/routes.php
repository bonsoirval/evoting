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
|	https://codeigniter.com/userguide3/general/routing.html
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
// News
// $route['news/create'] = 'news/create';
// $route['news/(:any)'] = 'paages/view'; //'news/view/$1';
// $route['news'] = 'news';
# Admin routes
$route['admin/add_party'] = 'admin/add_party';
$route['admin/manage_party'] = 'admin/manage_party';
$route['admin/add_election'] = 'admin/add_election';
$route['admin/manage_election'] = 'admin/manage_election';
$route['admin/add_voter_group'] = 'admin/add_voter_group';
$route['admin/manage_voter_group'] = 'admin/manage_voter_group';
$route['admin'] = 'admin/welcome/';

$route['login'] = 'voters/voter_login';
$route['register'] = 'voters/register_voter';
$route['voter_dashboard'] = 'voter_dashboard/index';
$route['vote'] = 'voter_dashboard/vote';
$route['logout'] = 'voters/voter_logout';


$route['default_controller'] = 'welcome';

// $route['(:any)'] = 'pages/view/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;