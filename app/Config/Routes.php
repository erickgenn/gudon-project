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
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('login');
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

$routes->get('/', 'AuthController::login');
$routes->get('home', 'Home::index');
$routes->get('home/bestproducts', 'Home::searchBestProducts');

// auth
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::loginAuth');
$routes->get('logout', 'AuthController::logout');
$routes->get('forgot_password/index', 'AuthController::forgot_password');

// $routes->get('forgot_password/auth', 'AuthController::forgot_password');//autentikasi email utk forgot password
$routes->post('forgot_password/authemail', 'AuthController::auth_forgotpass');
$routes->get('forgot_password/forgot/changepass/(:any)', 'AuthController::auth_changepass/$1');
$routes->post('forgot_password/forgot/newpass/(:any)', 'AuthController::new_password/$1');

$routes->get('forbidden', 'AdminController::forbidden');
$routes->get('expiredmembership', 'AuthController::expired_membership');

// admin pages
$routes->get('admin/index', 'AdminController::index');

//admin customer
$routes->get('admin/customer/index', 'CustomerController::index');
$routes->get('admin/customer/search', 'CustomerController::search');

//admin order
$routes->get('admin/order/index', 'OrderAdminController::index');
$routes->get('admin/order/search', 'OrderAdminController::search');
$routes->post('admin/order/(:num)/delete', 'OrderAdminController::delete/$1');
$routes->post('admin/order/confirm/(:num)', 'OrderAdminController::confirm/$1');

// admin login
$routes->get('login/admin', 'AuthController::loginAdmin');
$routes->post('login/auth/admin', 'AuthController::loginAuthAdmin');

$routes->post('register', 'AuthController::store');
$routes->get('register/index', 'AuthController::register');

// warehouse
$routes->get('/warehouse/index', 'WarehouseController::load_table');
$routes->get('/warehouse/search', 'WarehouseController::search');
$routes->get('/warehouse/view/(:num)', 'WarehouseController::view_shelf/$1');
$routes->get('/warehouse/view_product/(:num)', 'WarehouseController::view_product/$1');

// product
$routes->get('/product/index', 'ProductController::index');
$routes->get('/product/search', 'ProductController::search');
$routes->get('/product/add_product', 'ProductController::add_product');
$routes->get('/product/view/(:num)', 'ProductController::view_detail/$1');
$routes->post('product/update/(:num)', 'ProductController::update/$1');
$routes->post('product/store', 'ProductController::store');

//order
$routes->get('order/index', 'OrderController::index');
$routes->post('order/store', 'OrderController::store');
$routes->get('order/search', 'OrderController::search');
$routes->get('order/search/detail/(:num)', 'OrderController::searchDetail/$1');
$routes->get('order/view/(:num)', 'OrderController::view/$1');

// report
$routes->get('report/index', 'ReportController::index');
$routes->get('report/view/(:num)', 'ReportController::view/$1');
$routes->get('report/search', 'ReportController::search');

// payment
$routes->get('topup/method', 'PaymentController::method');
$routes->get('topup/view/(:any)', 'PaymentController::view/$1');
$routes->post('topup', 'PaymentController::store');

$routes->get('order/create_order', 'OrderController::create');
$routes->get('order/get_price/(:num)', 'OrderController::get_price/$1');
$routes->post('order/(:num)/delete', 'OrderController::delete/$1');

// membership
$routes->get('profile/index', 'MembershipLevelController::index');
$routes->get('membership/upgrade', 'MembershipLevelController::upgrade_menu');
$routes->get('membership/upgrade/(:num)', 'MembershipLevelController::upgrade/$1');
$routes->post('membership/payment', 'MembershipLevelController::payment');

// profile
$routes->post('profile/update', 'CustomerController::update_profile');

// notification
$routes->get('notification/index', 'NotificationController::index');
$routes->post('notification/update/(:num)/(:any)/(:any)', 'NotificationController::updateNotification/$1/$2/$3');
$routes->post('notification/delete/(:num)', 'NotificationController::delete/$1');

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
