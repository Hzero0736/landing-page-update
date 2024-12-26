<?php

require_once '../vendor/autoload.php';

use Config\Services;

$routes = Services::routes();

// Load the system's routing file first, so that the app can override it
if (file_exists(APPPATH . 'Config/Routes.php')) {
    require APPPATH . 'Config/Routes.php';
}

// Load the application routes
$routes->get('/', 'Home::index');
$routes->get('/booking', 'MeetingController::index');
$routes->post('/booking/save', 'MeetingController::save');
$routes->post('/booking/edit/(:num)', 'MeetingController::edit/$1');
$routes->delete('/booking/delete/(:num)', 'MeetingController::delete/$1');

$routes->get('/room', 'RoomController::index');
$routes->post('/room/add', 'RoomController::add');
$routes->post('/room/edit/(:num)', 'RoomController::edit/$1');
$routes->delete('/room/delete/(:num)', 'RoomController::delete/$1');

$routes->post('/user/add', 'UserController::add');

// Run the application
$application = Services::application();
$application->run();