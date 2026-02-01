<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth Routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::attemptRegister');
$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth']);

// Konfigurasi Routes
$routes->group('konfigurasi', ['filter' => 'auth'], function($routes) {
    // Role Manager
    $routes->get('role', 'Konfigurasi\RoleController::index');
    $routes->get('role/show/(:num)', 'Konfigurasi\RoleController::show/$1');
    $routes->post('role/create', 'Konfigurasi\RoleController::create');
    $routes->post('role/update/(:num)', 'Konfigurasi\RoleController::update/$1');
    $routes->delete('role/delete/(:num)', 'Konfigurasi\RoleController::delete/$1');
    
    // Menu Manager
    $routes->get('menu', 'Konfigurasi\MenuController::index');
    $routes->get('menu/show/(:num)', 'Konfigurasi\MenuController::show/$1');
    $routes->post('menu/create', 'Konfigurasi\MenuController::create');
    $routes->post('menu/update/(:num)', 'Konfigurasi\MenuController::update/$1');
    $routes->delete('menu/delete/(:num)', 'Konfigurasi\MenuController::delete/$1');
    $routes->post('menu/saveOrder', 'Konfigurasi\MenuController::saveOrder');
});
