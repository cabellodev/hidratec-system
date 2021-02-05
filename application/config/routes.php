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
//views Login
$route['default_controller'] = 'Login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login']['GET']= 'Login/index';
$route['menu']['GET']='Menu/loadMenu';
$route['adminUser']['GET']='User/adminUser';
//views admin OT 
$route['stagesOrder']['GET']='Orders/stagesOrder';
$route['adminOrders']['GET']='Orders/adminOrders';
//views admin resources
$route['adminComponent']['GET']='Component/adminComponent';
$route['adminBrand']['GET']='Brand/adminBrand';
$route['adminSubtask']['GET']='Subtask/adminSubtask';
$route['adminLocation']['GET']='Location/adminLocation';

//api admin resources 
//(Location)
$route['api/createLocation']['POST']='Location/createLocation';
$route['api/editLocation']['POST']='Location/editLocation';
$route['api/changeStateLocation']['POST']='Location/changeState';
$route['api/getLocation']['GET']='Location/getLocation';
//(Substask)
$route['api/createSubtask']['POST']='Subtask/createSubtask';
$route['api/editSubtask']['POST']='Subtask/editSubtask';
$route['api/changeStateSubtask']['POST']='Subtask/changeState';
$route['api/getSubtask']['GET']='Subtask/getSubtask';
//(Component)
$route['api/createComponent']['POST']='Component/createComponent';
$route['api/editComponent']['POST']='Component/editComponent';
$route['api/changeStateComponent']['POST']='Component/changeState';
$route['api/getComponent']['GET']='Component/getComponent';
//(Brand)
$route['api/createBrand']['POST']='Brand/createBrand';
$route['api/editBrand']['POST']='Brand/editBrand';
$route['api/changeStateBrand']['POST']='Brand/changeState';
$route['api/getBrand']['GET']='Brand/getBrand';


// api admin users
$route['api/createUser']['POST']= 'User/createUser';
$route['api/login']['POST'] = 'Login/LoginUser';
$route['api/logout']['POST'] = 'Login/logoutUser';
$route['api/editUser']['POST'] = 'User/editUser';
$route['api/createUser']['POST'] = 'User/createUser';
$route['api/getUsers']['GET'] = 'User/getUsers';
$route['api/changeState']['POST'] = 'User/changeState';
