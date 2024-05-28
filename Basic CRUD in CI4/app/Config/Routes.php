<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::login',['filter'=>'noauth']);
$routes->match(['get', 'post'], '/', 'Home::login', ['filter' => 'noauth']);
// $routes->get('/signup', 'Home::signup',['filter'=>'noauth']);
$routes->match(['get','post'],'signup', 'Home::signup',['filter'=>'noauth']);
$routes->match(['get','post'],'editUser/(:any)', 'Home::editUser/$1',['filter'=>'auth']);
$routes->match(['get','post'],'upload/(:any)', 'Home::upload/$1',['filter'=>'auth']);
$routes->match(['get','post'],'exportuserdata', 'Home::exportuserdata',['filter'=>'auth']);
$routes->get('dashboard', 'Home::dashboard',['filter'=>'auth']);
$routes->get('deleteUser/(:any)', 'Home::deleteUser/$1',['filter'=>'auth']);


$routes->get('logout', 'Home::logout');