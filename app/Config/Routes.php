<?php

use App\Controllers\RoomController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/booking', 'MeetingController::index', ['filter' => 'auth']);
$routes->post('/booking/save', 'MeetingController::save');
$routes->get('/booking/delete/(:num)', 'MeetingController::delete/$1');
$routes->post('/booking/edit/(:num)', 'MeetingController::edit/$1');

$routes->get('/meeting', 'Home::public');
$routes->get('/room', 'RoomController::index');
$routes->post('/room/add', 'RoomController::add');
$routes->get('/room/delete/(:num)', 'RoomController::delete/$1');
$routes->post('/room/edit/(:num)', 'RoomController::edit/$1');

$routes->get('/users', 'UserController::index');
$routes->post('/users/add', 'UserController::add');
$routes->get('/users/delete/(:num)', 'UserController::delete/$1');
$routes->post('/users/edit/(:num)', 'UserController::edit/$1');

$routes->get('/login', 'LoginController::index');
$routes->post('/login/auth', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');
