<?php
/**
 * Configuration
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Configuration
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */

/**
 * Environment configurations
 */
$environments = array(

    /**
     * Development environment
     */
    'dev'   => array(
        'app' => array(
            'driver'      => '',
            'host'        => '',
            'database'    => '',
            'username'    => '',
            'password'    => '',
            'charset'     => '',
            'collation'   => '',
            'prefix'      => '',
        ),
        'env' => array(
            'debug'       => true,
            'locale'      => '',
            'reporting'   => E_ALL ^ E_DEPRECATED ^ E_NOTICE | E_STRICT,
            'tidy_repair' => false,
            'timezone'    => '',
        ),
    ),

    /**
     * Testing environment
     */
    'test'  => array(
        'app' => array(
            'driver'      => '',
            'host'        => '',
            'database'    => '',
            'username'    => '',
            'password'    => '',
            'charset'     => '',
            'collation'   => '',
            'prefix'      => '',
        ),
        'env' => array(
            'debug'       => true,
            'locale'      => '',
            'reporting'   => E_ALL ^ E_DEPRECATED ^ E_NOTICE | E_STRICT,
            'tidy_repair' => false,
            'timezone'    => '',
        ),
    ),

    /**
     * Stage environment
     */
    'stage' => array(
        'app' => array(
            'driver'      => '',
            'host'        => '',
            'database'    => '',
            'username'    => '',
            'password'    => '',
            'charset'     => '',
            'collation'   => '',
            'prefix'      => '',
        ),
        'env' => array(
            'debug'       => false,
            'locale'      => '',
            'reporting'   => 0,
            'tidy_repair' => false,
            'timezone'    => '',
        ),
    ),

    /**
     * Production environment
     */
    'prod'  => array(
        'app' => array(
            'driver'      => '',
            'host'        => '',
            'database'    => '',
            'username'    => '',
            'password'    => '',
            'charset'     => '',
            'collation'   => '',
            'prefix'      => '',
        ),
        'env' => array(
            'debug'       => false,
            'locale'      => '',
            'reporting'   => 0,
            'tidy_repair' => false,
            'timezone'    => '',
        ),
    ),
);

/**
 * Application environment
 */
$app_env = 'prod';
if (getenv('APP_ENV') !== false)
    $app_env = getenv('APP_ENV');
elseif (getenv('REDIRECT_APP_ENV') !== false)
    $app_env = getenv('REDIRECT_APP_ENV');
define('APP_ENV', $app_env);

/**
 * Current environment not found
 */
if (isset($environments[APP_ENV]) === false)
    throw new \OutOfBoundsException('Undetectable environment. Please check the configuration file!');

/**
 * Set default timezone
 */
if (empty($environments[APP_ENV]['env']['timezone']) === false)
    date_default_timezone_set('Europe/Copenhagen');

/**
 * Set locale information
 */
if (empty($environments[APP_ENV]['env']['locale']) === false)
    setlocale(LC_ALL, 'da_DK.utf8');

/**
 * Set debugging mode
 */
define('APP_DEBUG', $environments[APP_ENV]['env']['debug']);

/**
 * Set error reporting level
 */
error_reporting($environments[APP_ENV]['env']['reporting']);

/**
 * Illuminate Database supports MySQL, Postgres, SQL Server, and SQLite
 */
if (isset($environments[APP_ENV])) {

    /**
     * Capsule manager providing expressive query builder, ActiveRecord style ORM and schema builder
     */
    $capsule = new Illuminate\Database\Capsule\Manager;

    /**
     * Connection for Capsule manager
     */
    $capsule->addConnection([
        'driver'    => $environments[APP_ENV]['app']['driver'],
        'host'      => $environments[APP_ENV]['app']['host'],
        'database'  => $environments[APP_ENV]['app']['database'],
        'username'  => $environments[APP_ENV]['app']['username'],
        'password'  => $environments[APP_ENV]['app']['password'],
        'charset'   => $environments[APP_ENV]['app']['charset'],
        'collation' => $environments[APP_ENV]['app']['collation'],
        'prefix'    => $environments[APP_ENV]['app']['prefix'],
    ]);

    /**
     * Setup Eloquent ORM
     */
    $capsule->bootEloquent();

}

/**
 * HTML Purifier configuration
 */
define('HTML_PURIFIER_CONFIG', json_encode(array(
    'Cache.SerializerPath' => APP_PATH . '/Cache',
    'Core.Encoding'        => 'UTF-8',
    'HTML.Doctype'         => 'HTML 4.01 Strict',
)));

/**
 * Tidy HTML repair setting
 */
define('TIDY', $local_machine['tidy_repair']);

/**
 * END ToucaNine/App/Config.php
 */