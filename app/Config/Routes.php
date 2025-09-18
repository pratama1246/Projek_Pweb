<?php

use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
$routes->get('/', 'halaman::index');

$routes->get('/buku', 'Buku::index');
$routes->get('/buku/tambah', 'Buku::tambah');
$routes->post('/buku/simpan', 'Buku::simpan');
$routes->get('/buku/ubah/(:num)', 'Buku::ubah/$1');
$routes->put('/buku/ubah/(:num)', 'Buku::update/$1'); // Baris yang diperbarui
$routes->delete('/buku/(:num)', 'Buku::hapus/$1');
$routes->get('/buku/(:num)', 'Buku::detail/$1');