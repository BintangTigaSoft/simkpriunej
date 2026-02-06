<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Root URL -> Login
$routes->get('/', 'Authentifikasi::index');

// Auth routes
$routes->get('auth', 'Authentifikasi::index');
$routes->get('login', 'Authentifikasi::index');
$routes->post('auth/process', 'Authentifikasi::process');

$routes->get('logout', 'Authentifikasi::logout');



// Toni CAS Process Route (dengan session CI4)
//$routes->get('auth/process_cas', 'Auth::process_cas');

// Toni Auth Routes
/*
$routes->get('/', 'Auth::index');
$routes->get('auth', 'Auth::index');
$routes->get('auth/sso', 'Auth::sso');
$routes->get('auth/form', 'Auth::form');
$routes->post('auth/process', 'Auth::process');
$routes->get('auth/logout', 'Auth::logout');
*/
// Toni Dashboard
$routes->get('dashboard', 'Dashboard::index');


// Toni users
$routes->group('users', function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('detail/(:segment)', 'Users::detail/$1');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:segment)', 'Users::edit/$1');
    $routes->post('update/(:segment)', 'Users::update/$1');

    // PERBAIKAN DISINI: Pastikan nama method sama
    $routes->get('deactivate/(:segment)', 'Users::deactivate/$1');
    $routes->get('activate/(:segment)', 'Users::activate/$1');

    $routes->get('reset-password/(:segment)', 'Users::reset_password/$1');
    $routes->get('export', 'Users::export');

    $routes->get('get-edit-data/(:segment)', 'Users::get_edit_data/$1');
    $routes->post('ajax-update', 'Users::ajax_update');

    $routes->get('get-form-data', 'Users::get_form_data');
    $routes->post('ajax-store', 'Users::ajax_store');


});


// Toni kendaraan

$routes->group('kendaraan', static function ($routes) {
    $routes->get('/', 'Kendaraan::index');
    $routes->get('load-more', 'Kendaraan::load_more');
    $routes->get('detail/(:num)', 'Kendaraan::detail/$1');
    $routes->get('create', 'Kendaraan::create');
    $routes->post('store', 'Kendaraan::store');
    $routes->get('get-form-data', 'Kendaraan::get_form_data');
    $routes->post('ajax-store', 'Kendaraan::ajax_store');
    $routes->get('get-edit-data/(:num)', 'Kendaraan::get_edit_data/$1');
    $routes->post('ajax-update', 'Kendaraan::ajax_update');
    $routes->post('delete/(:num)', 'Kendaraan::delete/$1');
    $routes->post('update-status/(:num)', 'Kendaraan::update_status/$1');
    $routes->get('export', 'Kendaraan::export');
});

// Toni kendaraan

$routes->get('kendaraan/image/(:any)', 'Kendaraan::image/$1');
$routes->get('kendaraan/image', 'Kendaraan::image');
