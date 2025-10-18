<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('announcements', 'Announcement::index');
$routes->group('teacher', ['filter' => 'roleauth'], static function ($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});
$routes->group('admin', ['filter' => 'roleauth'], static function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});
$routes->post('login', 'Auth::login');
$routes->get('login', 'Auth::showLogin');
$routes->get('dashboard', 'Dashboard::index');
