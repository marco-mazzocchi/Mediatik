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

$route['default_controller'] = 'journalists';
//$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth'] = 'auth/index';

// journalists
$route['journalists'] = 'journalists';
$route['journalists/(:num)/edit'] = 'journalists/edit/$1';
$route['journalists/create'] = 'journalists/create';
$route['journalists/(:num)/delete'] = 'journalists/delete/$1';
$route['journalists/update-field'] = 'journalists/updateField';

// news
$route['news/create'] = 'news/create';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';

// categories
$route['categories'] = 'categories';
$route['categories/(:num)/edit'] = 'categories/edit/$1';
$route['categories/(:num)/delete'] = 'categories/delete/$1';

// media types
$route['media-types'] = 'mediaTypes';
$route['media-types/(:num)/edit'] = 'mediaTypes/edit/$1';
$route['media-types/(:num)/delete'] = 'mediaTypes/delete/$1';

// journalistic heads
$route['journalistic-heads'] = 'journalisticHeads';
$route['journalistic-heads/(:num)'] = 'journalisticHeads/show/$1';
$route['journalistic-heads/(:num)/edit'] = 'journalisticHeads/edit/$1';
$route['journalistic-heads/(:num)/delete'] = 'journalisticHeads/delete/$1';
$route['journalistic-heads/periodicities'] = 'journalisticHeads/getAllperiodicities';

$route['(:any)'] = 'pages/view/$1';
