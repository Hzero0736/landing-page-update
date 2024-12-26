<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for user management
$routes->group('', ['filter' => 'isAdmin'], static function ($routes) {
    $routes->get('/users', 'UserController::index');
    $routes->post('/users/add', 'UserController::add');
    $routes->post('/users/edit/(:any)', 'UserController::edit/$1');
    $routes->delete('/users/delete/(:any)', 'UserController::delete/$1');
});

// Routes for meeting room management
$routes->group('', ['filter' => 'isAdmin'], static function ($routes) {
    $routes->get('/rooms', 'RoomController::index');
    $routes->post('/rooms/add', 'RoomController::add');
    $routes->post('/rooms/edit/(:any)', 'RoomController::edit/$1');
    $routes->delete('/rooms/delete/(:any)', 'RoomController::delete/$1');
});

// Routes for meeting management
$routes->group('', ['filter' => 'isAdminOrPetugas'], static function ($routes) {
    $routes->get('/meetings', 'MeetingController::index');
    $routes->post('/meetings/add', 'MeetingController::save');
    $routes->post('/meetings/edit/(:any)', 'MeetingController::edit/$1');
    $routes->delete('/meetings/delete/(:any)', 'MeetingController::delete/$1');
});

// Routes for authentication
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login');
$routes->get('/logout', 'Login::logout');