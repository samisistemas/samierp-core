<?php
$database = [
    'default' => env('DB_CONNECTION', 'institutional'),

    'connections' => [
        'sqlite' => [
            'driver'                  => 'sqlite',
            'url'                     => env('DATABASE_URL'),
            'database'                => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'                  => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'institutional' => [
            'driver'         => 'mysql',
            'url'            => env('DATABASE_URL'),
            'host'           => env('DB_HOST_INSTITUTIONAL', 'bdinst.whmsam.com.br'),
            'port'           => env('DB_PORT_INSTITUTIONAL', '3306'),
            'database'       => env('DB_DATABASE_INSTITUTIONAL', 'dbinstitucional'),
            'username'       => env('DB_USERNAME_INSTITUTIONAL', 'weberpuser'),
            'password'       => env('DB_PASSWORD_INSTITUTIONAL'),
            'charset'        => 'utf8mb4',
            'collation'      => 'utf8mb4_unicode_ci',
            'prefix'         => '',
            'prefix_indexes' => true,
            'strict'         => true,
            'engine'         => null,
            'options'        => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ],

    'migrations' => 'migrations',
];

if (env('APP_ENV') === 'local' && env('DB_DATABASE_DEV')) {
    $devConfig = [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_DEV', '170.244.220.66'),
        'port'      => env('DB_PORT_DEV', '3309'),
        'database'  => env('DB_DATABASE_DEV'),
        'username'  => env('DB_USERNAME_DEV', 'root'),
        'password'  => env('DB_PASSWORD_DEV'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        'engine'    => null,
    ];

    $database['connections']['web_customer']   = $devConfig;
    $database['connections']['local_customer'] = $devConfig;
}

return $database;
