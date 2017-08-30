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
$route['seo/sitemap\.xml'] = "seo";
$route['default_controller'] = "home";
$route['404_override'] = '';
$route['^(:any).htm'] = "pages/index/$1";

 

/* End of file routes.php */
/* Location: ./application/config/routes.php */
$route['/'] = 'home';

$route['register'] = 'home/register';

$route['user'] = 'user/index';
$route['user/logout'] = 'user/logout';
$route['user/home'] = 'user/home';
$route['verifymobile'] = 'user/verifymobile';


$route['organisation'] = 'organisation/index';
$route['organisation/(:num)/(:any)'] = 'organisation/view/$1';

$route['(:any)/profile'] = 'buddy/profile/$1';
   
$route['user/profile'] = 'user/profile';
$route['buddies'] = 'buddy/buddies';
$route['user/sociallogin/(:any)'] = 'user/sociallogin/$1';
$route['message/inbox/view/(:any)'] = 'message/inboxview/$1';
$route['message/sent/view/(:any)'] = 'message/sentview/$1';
$route['message/trash/view/(:any)'] = 'message/trashview/$1';
$route['home/educationInformation/(:any)'] = 'home/educationInformation/$1';
 
$route['activity'] = 'home/activity';
$route['getLocations'] = 'home/getLocations';
 
