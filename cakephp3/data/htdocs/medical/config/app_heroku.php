<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
$db = parse_url(env('CLEARDB_DATABASE_URL'));
return [
    /*
     * Debug Level: 
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    //'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),
    'debug' => false,

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        //'salt' => env('SECURITY_SALT', '__SALT__'),
        'salt' => env('SALT'),
    ],
    'Cache' => [
        'default' => [
            'className' => 'Memcached',
            'prefix' => 'myapp_cake_',
            'servers' => [env('MEMCACHIER_SERVERS')],
            'username' => env('MEMCACHIER_USERNAME'),
            'password' => env('MEMCACHIER_PASSWORD'),
            'duration' => '+1440 minutes',
        ],

        'session' => [
            'className' => 'Memcached',
            'prefix' => 'myapp_cake_session_',
            'servers' => [env('MEMCACHIER_SERVERS')],
            'username' => env('MEMCACHIER_USERNAME'),
            'password' => env('MEMCACHIER_PASSWORD'),
            'duration' => '+1440 minutes',
        ],

        '_cake_core_' => [
            'className' => 'Memcached',
            'prefix' => 'myapp_cake_core_',
            'servers' => [env('MEMCACHIER_SERVERS')],
            'username' => env('MEMCACHIER_USERNAME'),
            'password' => env('MEMCACHIER_PASSWORD'),
            'duration' => '+1 years',
        ],

        '_cake_model_' => [
            'className' => 'Memcached',
            'prefix' => 'myapp_cake_model_',
            'servers' => [env('MEMCACHIER_SERVERS')],
            'username' => env('MEMCACHIER_USERNAME'),
            'password' => env('MEMCACHIER_PASSWORD'),
            'duration' => '+1 years',
        ],
    ]

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            // 'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',
            // 'username' => 'my_app',
            // 'password' => 'secret',
            // 'database' => 'my_app',
            // 'log' => true,
            // 'url' => env('DATABASE_URL', null),

            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => $db['host'],
            'username' => $db['user'],
            'password' => $db['pass'],
            'database' => substr($db['path'], 1),
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    // 'EmailTransport' => [
    //     'default' => [
    //         'host' => 'localhost',
    //         'port' => 25,
    //         'username' => null,
    //         'password' => null,
    //         'client' => null,
    //         'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
    //     ],
    // ],
    'Session' => [
        'defaults' => 'cache',
        'handler' => [
            'config' => 'session'
        ]
    ],
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\ConsoleLog',
            'stream' => 'php://stdout',
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\ConsoleLog',
            'stream' => 'php://stderr',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
    ],
];
