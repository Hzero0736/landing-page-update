<?php

use App\Controllers\RoomController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/booking', 'MeetingController::index');
$routes->post('/booking/save', 'MeetingController::save');
$routes->get('/booking/delete/(:num)', 'MeetingController::delete/$1');
$routes->post('/booking/edit/(:num)', 'MeetingController::edit/$1');

$routes->get('/meeting', 'Home::public');

$routes->get('/room', 'RoomController::index');
$routes->post('/room/add', 'RoomController::add');
$routes->get('/room/delete/(:num)', 'RoomController::delete/$1');
$routes->post('/room/edit/(:num)', 'RoomController::edit/$1');
