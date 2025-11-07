<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Mahasiswa::index');
$routes->get('/mahasiswa/getData', 'Mahasiswa::getData');
$routes->post('/mahasiswa/add', 'Mahasiswa::add');
$routes->get('/mahasiswa/delete/(:num)', 'Mahasiswa::delete/$1');
$routes->post('/mahasiswa/save', 'Mahasiswa::save');
$routes->get('/mahasiswa/get/(:num)', 'Mahasiswa::get/$1');
