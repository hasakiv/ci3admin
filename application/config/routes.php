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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'BlogController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dangnhap'] = 'admin/dashboard';
$route['duongham/password'] = 'Auth_original/forgot_password';
$route['dangnhap/prefs/interfaces/(:any)'] = 'admin/prefs/interfaces/$1';

// CRUD POSTS
$route['admin/posts'] = 'admin/Post/index';
$route['admin/posts/add'] = 'admin/Post/form_posts';
//$route['admin/post_save'] = 'admin/Post/post_save';
$route['admin/edit/(:any)'] = "admin/Post/post_edit/$1";
$route['admin/delete/(:any)'] = "admin/Post/post_delete/$1";
$route['admin/update/(:any)'] = "admin/Post/post_update/$1";

$route['admin/media'] = 'admin/UploadController/upload_view';
$route['upload'] = 'admin/Post/upload';
$config['base_url'] = 'https://anhsex2k.xyz/';

$route['admin/posts/search'] = 'admin/Post/search';

// CRUD CATEGORY
$route['admin/category'] = 'admin/Post/category_show';
$route['admin/add-category'] = 'admin/Post/category_ctl';
$route['admin/save_category'] = 'admin/Post/category_save';
$route['admin/cat_edit/(:any)'] = 'admin/Post/cat_edit/$1';
$route['admin/cat_update/(:any)'] = "admin/Post/cat_update/$1";
$route['admin/cat_delete/(:any)'] = 'admin/Post/cat_delete/$1';
// Url Seo
$route['post/(:any)'] = 'BlogController/detail/$1';
// Show post in category
$route['category/(:any)'] = 'BlogController/display_category/$1';
$route['page/(:num)'] = 'BlogController/index/page/$1';
//$route['admin/posts/page/(:num)'] = 'admin/Post/index/page/$1';
$route['/'] = 'BlogController/index/page/$0';
// Sitemap
//$route['sitemap\.xml'] = "Sitemap/index";
$route['sitemap/sitemap\.xml'] = "Sitemap/index";