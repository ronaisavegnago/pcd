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
$route['default_controller'] = 'home_c';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['classe'] = "Classe_c/index";
$route['classe/adicionar'] = "Classe_c/novo";
$route['classe/(:any)'] = "Classe_c/ver/$1";
$route['classe/editar/(:any)'] = "Classe_c/edita/$1";
$route['classe/extinguir/(:any)'] = "Classe_c/extinguir/$1";

$route['subclasse'] = "Subclasse_c/index";
$route['subclasse/adicionar'] = "Subclasse_c/novo";
$route['subclasse/(:any)'] = "subclasse_c/ver/$1";
$route['subclasse/editar/(:any)'] = "subclasse_c/editar/$1";
$route['subclasse/extinguir/(:any)'] = "subclasse_c/extinguir/$1";

$route['grupo'] = "Grupo_c/index";
$route['grupo/adicionar'] = "Grupo_c/novo";
$route['grupo/(:any)'] = "Grupo_c/ver/$1";
$route['grupo/editar/(:any)'] = "Grupo_c/edita/$1";
$route['grupo/extinguir/(:any)'] = "Grupo_c/extinguir/$1";

$route['subgrupo'] = "Subgrupo_c/index";
$route['subgrupo/adicionar'] = "Subgrupo_c/novo";
$route['subclasse/(:any)'] = "Subclasse_c/ver/$1";
$route['subclasse/editar/(:any)'] = "Subclasse_c/edita/$1";
$route['subclasse/extinguir/(:any)'] = "Subclasse_c/extinguir/$1";