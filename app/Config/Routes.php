<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for user management
$routes->group('', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/users', 'UserController::index');
    $routes->post('/users/add', 'UserController::add');
    $routes->post('/users/edit/(:any)', 'UserController::edit/$1');
    $routes->delete('/users/delete/(:any)', 'UserController::delete/$1');
});

// Routes for meeting room management
$routes->group('', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/rooms', 'RoomController::index');
    $routes->post('/rooms/add', 'RoomController::add');
    $routes->post('/rooms/edit/(:any)', 'RoomController::edit/$1');
    $routes->delete('/rooms/delete/(:any)', 'RoomController::delete/$1');
    $routes->get('/approval', 'MeetingController::listApproval');
    $routes->get('booking/approve/(:num)', 'MeetingController::approve/$1');
    $routes->post('booking/reject/(:num)', 'MeetingController::reject/$1');
});
// Routes for meeting management
$routes->group('', ['filter' => 'adminpetugas'], static function ($routes) {
    $routes->get('/booking', 'MeetingController::index', ['filter' => 'auth']);
    $routes->post('/booking/save', 'MeetingController::save');
    $routes->get('/booking/delete/(:num)', 'MeetingController::delete/$1');
    $routes->post('/booking/edit/(:num)', 'MeetingController::edit/$1');
});

$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/meeting', 'Home::public');
$routes->post('/login/auth', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');
