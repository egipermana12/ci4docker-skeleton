<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');

$routes->get('register', 'Register::index');
$routes->post('register', 'Register::register');

$routes->get('auth/activate/(:hash)', 'Register::activate/$1');

//login somsmed 
$routes->get('auth/facebook', 'AuthSosmed::facebook');
$routes->get('auth/facebook/callback', 'AuthSosmed::facebookCallback');

$routes->get('auth/google', 'AuthSosmed::google');
$routes->get('auth/google/callback', 'AuthSosmed::googleCallback');


$routes->group('dashboard', ['filter' => ['hasLogin', 'rememberme']], function ($routes) {
    $routes->get('/', 'Home::dashboard');
});

$routes->group('tenants', ['filter' => ['hasLogin', 'rememberme']], function ($routes) {
    $routes->get('/', 'TenantsController::index');
    $routes->get('fetch', 'TenantsController::fetchData');
    $routes->post('/', 'TenantsController::create');
});
