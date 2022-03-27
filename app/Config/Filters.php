<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'authGuard' => \App\Filters\AuthGuard::class,
        'authAdmin' => \App\Filters\AdminGuard::class,
        'expGuard' => \App\Filters\ExpiredMembershipGuard::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'authGuard' => [
                'except' =>
                [
                    'login',
                    'register/index',
                    'register',
                    'forgot_password/index',
                    'login/auth',
                    'login/admin',
                    'login/auth/admin',
                    'forgot_password/authemail',
                    'forgot_password/forgot/changepass/*',
                    'forgot_password/forgot/newpass/*',
                ],
            ],
            'authAdmin' => [
                'except' =>
                [
                    '/',
                    'login',
                    'logout',
                    'register/index',
                    'register',
                    'forgot_password/index',
                    'login/auth',
                    'forbidden',
                    'login/admin',
                    'login/auth/admin',
                    '/warehouse/index',
                    '/warehouse/search',
                    '/warehouse/view/*',
                    '/warehouse/view_product/*',
                    '/product/add_product',
                    '/product/index',
                    '/product/search',
                    '/product/view/*',
                    'product/update/*',
                    'product/store',
                    'order/index',
                    'order/search',
                    'order/store',
                    'order/search/detail/*',
                    'order/view/*',
                    'order/create_order',
                    'order/get_price/*',
                    'order/*/delete',
                    'profile/index',
                    'membership/upgrade',
                    'membership/upgrade/*',
                    'membership/payment',
                    'profile/update',
                    'home',
                    'report/index',
                    'report/search',
                    'report/view/*',
                    'forgot_password/authemail',
                    'forgot_password/forgot/changepass/*',
                    'forgot_password/forgot/newpass/*',
                    'topup/method',
                    'topup/view/*',
                    'topup',
                    'profile/update',
                    'home/bestproducts',
                    'notification/index',
                    'notification/update/*/*/*',
                    'notification/delete/*',
                    'expiredmembership',
                    'delivery/getprovinsi',
                    'delivery/getcity/*',
                ]
            ],
            'expGuard' => [
                'except' =>
                [
                    '/',
                    'login',
                    'logout',
                    'register/index',
                    'register',
                    'forgot_password/index',
                    'login/auth',
                    'forbidden',
                    'login/admin',
                    'login/auth/admin',
                    'profile/index',
                    'membership/upgrade',
                    'membership/upgrade/*',
                    'membership/payment',
                    'profile/update',
                    'home',
                    'forgot_password/authemail',
                    'forgot_password/forgot/changepass/*',
                    'forgot_password/forgot/newpass/*',
                    'topup/method',
                    'topup/view/*',
                    'topup',
                    'home/bestproducts',
                    'expiredmembership',
                    'admin/index',
                    'admin/customer/index',
                    'admin/customer/search',
                    'admin/order/index',
                    'admin/order/search',
                    'admin/order/*/delete',
                    'admin/order/confirm/*',
                    'order/view/*',
                    'notification/admin/update/*/*/*',
                    'admin/notification/index',
                    'admin/order/view/*',
                    'admin/warehouse/index',
                    'admin/warehouse/search',
                    'admin/warehouse/view/*',
                    'admin/warehouse/view_product/*',
                    'admin/warehouse/create',
                    'admin/warehouse/store',
                    'admin/product/index',
                    'admin/product/search',
                    'admin/product/view/*',
                    'admin/product/update/*',
                    'admin/product/search/not_assigned',
                    'admin/product/get_shelf/*',
                    'admin/report/index',
                    'admin/report/search',
                    'admin/report/searchAll',
                    'admin/report/searchCust',
                    'admin/report/view/*',
                    'delivery/getprovinsi',
                    'delivery/getcity/*',
                ]
            ],

            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
