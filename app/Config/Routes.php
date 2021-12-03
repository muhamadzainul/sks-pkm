<?php

namespace Config;

use CodeIgniter\Commands\Utilities\Routes;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Admin\Administrator::index');
$routes->get('/administrator/(:any)', 'Admin\Administrator::$1');
// auth
$routes->get('/auth', 'Auth::index');
$routes->get('/auth/register2', 'Auth::register2');
// data pasien
// admin
$routes->get('/admin/data_pasien', 'Admin\Data_pasien::index');
$routes->delete('/Admin/data_pasien/(:num)', 'Admin\data_pasien::hapus_data/$1');
$routes->get('/admin/admin/data_pasien/(:num)', 'Admin\data_pasien::hapus_data/$1');
$routes->get('/admin/data_pasien/edit_data/(:segment)', 'Admin\Data_pasien::edit_data/$1');
$routes->get('/admin/data_pasien/detail_pasien/(:segment)', 'Admin\Data_pasien::detail_pasien/$1');
$routes->get('/admin/data_pasien/update_data/(:segment)', 'Admin\Data_pasien::update_data/$1');
$routes->get('/admin/data_pasien/(:any)', 'Admin\Data_pasien::$1');
$routes->get('/admin/data_pasien/simpan', 'Admin\Data_pasien::simpan');
//petugas
$routes->get('/petugas/data_pasien', 'Petugas\Data_pasien::index');
$routes->delete('/Admin/data_pasien/(:num)', 'Petugas\data_pasien::hapus_data/$1');
$routes->get('/petugas/data_pasien/(:num)', 'Petugas\data_pasien::hapus_data/$1');
$routes->get('/petugas/data_pasien/edit_data/(:segment)', 'Petugas\Data_pasien::edit_data/$1');
$routes->get('/petugas/data_pasien/detail_pasien/(:segment)', 'Petugas\Data_pasien::detail_pasien/$1');
$routes->get('/petugas/data_pasien/update_data/(:segment)', 'Petugas\Data_pasien::update_data/$1');
$routes->get('/petugas/data_pasien/(:any)', 'Petugas\Data_pasien::$1');
$routes->get('/petugas/data_pasien/simpan', 'Petugas\Data_pasien::simpan');

// data petugas
$routes->get('/admin/data_petugas', 'Admin\Data_petugas::index');
$routes->delete('/Admin/data_petugas/(:num)', 'Admin\data_petugas::hapus_data/$1');
$routes->get('/admin/data_petugas/(:num)', 'Admin\data_petugas::hapus_data/$1');
$routes->get('/admin/data_petugas/edit_data/(:segment)', 'Admin\Data_petugas::edit_data/$1');
$routes->get('/admin/data_petugas/detail_petugas/(:segment)', 'Admin\Data_petugas::detail_petugas/$1');
$routes->get('/admin/data_petugas/update_data/(:segment)', 'Admin\Data_petugas::update_data/$1');
$routes->get('/admin/data_petugas/(:any)', 'Admin\Data_petugas::$1');
$routes->get('/admin/data_petugas/simpan', 'Admin\Data_petugas::simpan');
// data surat
//admin
$routes->get('/admin/surat_sehat', 'Admin\Surat_sehat::index');
$routes->delete('/Admin/surat_sehat/(:num)', 'Admin\surat_sehat::hapus_data/$1');
$routes->get('/admin/surat_sehat/(:num)', 'Admin\surat_sehat::hapus_data/$1');
$routes->get('/admin/surat_sehat/edit_data/(:segment)', 'Admin\Surat_sehat::edit_data/$1');
$routes->get('/admin/surat_sehat/detail_surat/(:segment)', 'Admin\Surat_sehat::detail_surat/$1');
$routes->get('/admin/surat_sehat/update_data/(:segment)', 'Admin\Surat_sehat::update_data/$1');
$routes->get('/admin/surat_sehat/(:any)', 'Admin\Surat_sehat::$1');
$routes->get('/admin/surat_sehat/simpan', 'Admin\Surat_sehat::simpan');
//petugas
$routes->get('/petugas/surat_sehat', 'Petugas\Surat_sehat::index');
$routes->delete('/Petugas/surat_sehat/(:num)', 'Petugas\surat_sehat::hapus_data/$1');
$routes->get('/petugas/surat_sehat/(:num)', 'Petugas\surat_sehat::hapus_data/$1');
$routes->get('/petugas/surat_sehat/edit_data/(:segment)', 'Petugas\Surat_sehat::edit_data/$1');
$routes->get('/petugas/surat_sehat/detail_surat/(:segment)', 'Petugas\Surat_sehat::detail_petugas/$1');
$routes->get('/petugas/surat_sehat/update_data/(:segment)', 'Petugas\Surat_sehat::update_data/$1');
$routes->get('/petugas/surat_sehat/(:any)', 'Petugas\Surat_sehat::$1');
$routes->get('/petugas/surat_sehat/simpan', 'Petugas\Surat_sehat::simpan');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
