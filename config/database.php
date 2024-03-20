<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5050'),
            'database' => env('DB_DATABASE', 'osm_app'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                PDO::ATTR_TIMEOUT => 60, // Set the connection timeout to 60 seconds
            ],
        ],

        'conn_golaghat' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_SECOND', 'forge'),
            'username' => env('DB_USERNAME_SECOND', 'forge'),
            'password' => env('DB_PASSWORD_SECOND', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_baksa' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_3', 'forge'),
            'username' => env('DB_USERNAME_3', 'forge'),
            'password' => env('DB_PASSWORD_3', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_barpeta' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_4', 'forge'),
            'username' => env('DB_USERNAME_4', 'forge'),
            'password' => env('DB_PASSWORD_4', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_bongaigaon' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_5', 'forge'),
            'username' => env('DB_USERNAME_5', 'forge'),
            'password' => env('DB_PASSWORD_5', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_cachar' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_6', 'forge'),
            'username' => env('DB_USERNAME_6', 'forge'),
            'password' => env('DB_PASSWORD_6', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_charaideo' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_7', 'forge'),
            'username' => env('DB_USERNAME_7', 'forge'),
            'password' => env('DB_PASSWORD_7', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_chirang' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_8', 'forge'),
            'username' => env('DB_USERNAME_8', 'forge'),
            'password' => env('DB_PASSWORD_8', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_darrang' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_9', 'forge'),
            'username' => env('DB_USERNAME_9', 'forge'),
            'password' => env('DB_PASSWORD_9', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_dhemaji' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_10', 'forge'),
            'username' => env('DB_USERNAME_10', 'forge'),
            'password' => env('DB_PASSWORD_10', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_dhubri' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_11', 'forge'),
            'username' => env('DB_USERNAME_11', 'forge'),
            'password' => env('DB_PASSWORD_11', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_dibrugarh' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_12', 'forge'),
            'username' => env('DB_USERNAME_12', 'forge'),
            'password' => env('DB_PASSWORD_12', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_dimahasao' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_13', 'forge'),
            'username' => env('DB_USERNAME_13', 'forge'),
            'password' => env('DB_PASSWORD_13', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_goalpara' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_14', 'forge'),
            'username' => env('DB_USERNAME_14', 'forge'),
            'password' => env('DB_PASSWORD_14', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_hailakandi' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_15', 'forge'),
            'username' => env('DB_USERNAME_15', 'forge'),
            'password' => env('DB_PASSWORD_15', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_jorhat' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_16', 'forge'),
            'username' => env('DB_USERNAME_16', 'forge'),
            'password' => env('DB_PASSWORD_16', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_kamrup_metropolitan' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_17', 'forge'),
            'username' => env('DB_USERNAME_17', 'forge'),
            'password' => env('DB_PASSWORD_17', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_kamrup' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_18', 'forge'),
            'username' => env('DB_USERNAME_18', 'forge'),
            'password' => env('DB_PASSWORD_18', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_karbi_anglong' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_19', 'forge'),
            'username' => env('DB_USERNAME_19', 'forge'),
            'password' => env('DB_PASSWORD_19', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_karimganj' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_20', 'forge'),
            'username' => env('DB_USERNAME_20', 'forge'),
            'password' => env('DB_PASSWORD_20', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_kokrajhar' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_21', 'forge'),
            'username' => env('DB_USERNAME_21', 'forge'),
            'password' => env('DB_PASSWORD_21', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_lakhimpur' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_22', 'forge'),
            'username' => env('DB_USERNAME_22', 'forge'),
            'password' => env('DB_PASSWORD_22', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_majuli' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_23', 'forge'),
            'username' => env('DB_USERNAME_23', 'forge'),
            'password' => env('DB_PASSWORD_23', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_morigaon' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_24', 'forge'),
            'username' => env('DB_USERNAME_24', 'forge'),
            'password' => env('DB_PASSWORD_24', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_nagaon' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_25', 'forge'),
            'username' => env('DB_USERNAME_25', 'forge'),
            'password' => env('DB_PASSWORD_25', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_nalbari' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_26', 'forge'),
            'username' => env('DB_USERNAME_26', 'forge'),
            'password' => env('DB_PASSWORD_26', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_shivsagar' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_27', 'forge'),
            'username' => env('DB_USERNAME_27', 'forge'),
            'password' => env('DB_PASSWORD_27', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_sonitpur' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_28', 'forge'),
            'username' => env('DB_USERNAME_28', 'forge'),
            'password' => env('DB_PASSWORD_28', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_south_salmara_mancachar' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_29', 'forge'),
            'username' => env('DB_USERNAME_29', 'forge'),
            'password' => env('DB_PASSWORD_29', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_tinsukia' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_30', 'forge'),
            'username' => env('DB_USERNAME_30', 'forge'),
            'password' => env('DB_PASSWORD_30', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_udalguri' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_31', 'forge'),
            'username' => env('DB_USERNAME_31', 'forge'),
            'password' => env('DB_PASSWORD_31', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_west_karbi_anglong' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_32', 'forge'),
            'username' => env('DB_USERNAME_32', 'forge'),
            'password' => env('DB_PASSWORD_32', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_biswanath' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_33', 'forge'),
            'username' => env('DB_USERNAME_33', 'forge'),
            'password' => env('DB_PASSWORD_33', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_hojai' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_34', 'forge'),
            'username' => env('DB_USERNAME_34', 'forge'),
            'password' => env('DB_PASSWORD_34', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_bajali' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_35', 'forge'),
            'username' => env('DB_USERNAME_35', 'forge'),
            'password' => env('DB_PASSWORD_35', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'conn_tamulpur' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE_36', 'forge'),
            'username' => env('DB_USERNAME_36', 'forge'),
            'password' => env('DB_PASSWORD_36', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],


        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
