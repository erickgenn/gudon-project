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
$routes->get('admin/order/view/(:num)', 'OrderAdminController::view/$1');

//admin warehouse
$routes->get('admin/warehouse/index', 'WarehouseAdminController::index');
$routes->get('admin/warehouse/search', 'WarehouseAdminController::search');
$routes->get('admin/warehouse/create', 'WarehouseAdminController::create');
$routes->post('admin/warehouse/store', 'WarehouseAdminController::store');
$routes->get('admin/warehouse/view/(:num)', 'WarehouseAdminController::view_shelf/$1');
$routes->get('admin/warehouse/view_product/(:num)', 'WarehouseAdminController::view_product/$1');

//admin product
$routes->get('admin/product/index', 'ProductAdminController::index');
$routes->get('admin/product/search', 'ProductAdminController::search');
$routes->get('admin/product/search/not_assigned', 'ProductAdminController::search_not_assigned');
$routes->get('admin/product/view/(:num)', 'ProductAdminController::view_detail/$1');
$routes->post('admin/product/update/(:num)', 'ProductAdminController::update/$1');
$routes->get('admin/product/get_shelf/(:num)', 'ProductAdminController::get_shelf/$1');
$routes->post('admin/product/updatePicture/(:num)', 'ProductAdminController::updatePicture/$1');
$routes->post('admin/product/declinePicture/(:num)', 'ProductAdminController::declinePicture/$1');

// admin login
$routes->get('login/admin', 'AuthController::loginAdmin');
$routes->post('login/auth/admin', 'AuthController::loginAuthAdmin');

//admin report
$routes->get('admin/report/index', 'AdminReportController::index');
$routes->get('admin/report/search', 'AdminReportController::search');
$routes->get('admin/report/searchAll', 'AdminReportController::searchAll');
$routes->get('admin/report/searchCust', 'AdminReportController::searchCustomer');
$routes->get('admin/report/view/(:num)', 'AdminReportController::view/$1');

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
$routes->post('product/updatePicture/(:num)', 'ProductController::updatePicture/$1');

//order
$routes->get('order/index', 'OrderController::index');
$routes->post('order/store', 'OrderController::store');
$routes->get('order/search', 'OrderController::search');
$routes->get('order/search/detail/(:num)', 'OrderController::searchDetail/$1');
$routes->get('order/view/(:num)', 'OrderController::view/$1');
$routes->get('order/create_order', 'OrderController::create');
$routes->get('order/get_price/(:num)', 'OrderController::get_price/$1');
$routes->post('order/(:num)/delete', 'OrderController::delete/$1');

// report
$routes->get('report/index', 'ReportController::index');
$routes->get('report/view/(:num)', 'ReportController::view/$1');
$routes->get('report/search', 'ReportController::search');

// payment
$routes->get('topup/method', 'PaymentController::method');
$routes->get('topup/view/(:any)', 'PaymentController::view/$1');
$routes->post('topup', 'PaymentController::store');

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
$routes->post('notification/admin/update/(:num)/(:any)/(:any)', 'AdminController::updateAdminNotification/$1/$2/$3');
$routes->get('admin/notification/index', 'AdminController::notification_index');

// delivery
$routes->get('delivery/getprovinsi', 'DeliveryController::getProvinsi');
$routes->get('delivery/getcity/(:num)', 'DeliveryController::getCity/$1');

//kurir
$routes->get('delivery/getkurir', 'DeliveryController::getKurir');
$routes->get('delivery/getservice/(:num)/(:num)/(:any)', 'DeliveryController::getService/$1/$2/$3');


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
