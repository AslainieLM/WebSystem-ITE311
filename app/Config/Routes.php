<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/about','Home::about');
$routes->get('/contact','Home::contact');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');

$routes->get(from: '/admin/dashboard', to: 'Admin::dashboard');
$routes->get(from: '/teacher/dashboard', to: 'Teacher::dashboard');
$routes->get(from: '/student/dashboard', to: 'Student::dashboard');
