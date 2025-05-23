<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'Login::index');
$routes->post('login', 'Login::login');

$routes->get('register', 'Register::index');
$routes->post('register', 'Register::register');

$routes->get('auth/activate/(:hash)', 'Register::activate/$1');

$routes->get('dashboard', 'Home::dashboard');
