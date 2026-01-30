<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth Routes
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::attempt');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth']); // Placeholder for dashboard
