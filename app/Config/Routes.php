<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('home');
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


$routes->get('home', 'Home::index');

$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::loginAuth');
$routes->get('logout', 'AuthController::logout');

$routes->post('register', 'AuthController::store');
$routes->get('register/index', 'AuthController::register');

// warehouse
$routes->get('/warehouse/index', 'WarehouseController::load_table');
$routes->get('/warehouse/view/(:num)', 'WarehouseController::view_detail/$1');
$routes->get('/warehouse/view_v2/(:num)', 'WarehouseController::view_detail_v2/$1');

//order
$routes->get('order/index', 'OrderController::index');
$routes->get('order/store', 'OrderController::store');
$routes->get('order/search', 'OrderController::search');
$routes->get('order/view/(:num)', 'OrderController::view/$1');
$routes->get('order/(:num)/delete', 'OrderController::delete/$1');
$routes->get('order/create_order', 'OrderController::create');



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
