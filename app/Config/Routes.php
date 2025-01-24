<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');


$routes->get('/admin', 'Admin::index');
$routes->get('/admin/getDataAdmin', 'Admin::getDataAdmin');
$routes->get('/admin/formTambahData', 'Admin::formTambahData');
$routes->post('/admin/simpanData', 'Admin::simpanData');
$routes->post('/admin/formEditData', 'Admin::formEditData');
$routes->post('/admin/updateData', 'Admin::updateData');


$routes->get('/member', 'Member::index');
