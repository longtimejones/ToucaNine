<?php
/**
 * Configuration
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Configuration
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */

/**
 * Default timezone
 */
date_default_timezone_set('Europe/Copenhagen');

/**
 * Locale information
 */
setlocale(LC_ALL, 'da_DK.utf8');

/**
 * Local machines
 */
$machines = array(
    /**
     * Production machine
     */
    'p_machine_name'  => array(
        'debug'       => false,
        'env'         => 'prod',
        'reporting'   => 0,
        'tidy_repair' => false,
    ),
    /**
     * Stage machine
     */
    's_machine_name'  => array(
        'debug'       => false,
        'env'         => 'stage',
        'reporting'   => 0,
        'tidy_repair' => false,
    ),
    /**
     * Test machine
     */
    't_machine_name'  => array(
        'debug'       => true,
        'env'         => 'test',
        'reporting'   => E_ALL ^ E_DEPRECATED ^ E_NOTICE | E_STRICT,
        'tidy_repair' => false,
    ),
);

/**
 * Local host name
 */
$local_host_name = gethostname();

if ($local_host_name === false)
    throw new \UnexpectedValueException('Cannot retrieve local host name for environment settings!');

/**
 * Current machine
 */
if (!isset($machines[$local_host_name]))
    throw new \OutOfBoundsException('Undetectable local machine. Please check the configuration file!');

/**
 * Current machine
 */
$local_machine = $machines[$local_host_name];

/**
 * Environment mode
 */
define('ENV', $local_machine['env']);

/**
 * Debugging state
 */
define('DEBUG', $local_machine['debug']);

/**
 * Error reporting level
 */
error_reporting($local_machine['reporting']);

/**
 * Database configuration
 *
 * Support for MySQL, Postgres, SQL Server and SQLite
 */
$db = array(
    'prod' => array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'database',
        'username'  => 'root',
        'password'  => 'password',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),
    'stage' => array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'database',
        'username'  => 'root',
        'password'  => 'password',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),
    'test' => array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'database',
        'username'  => 'root',
        'password'  => 'password',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ),
);

/**
 * Illuminate Database
 */
if (isset($db[ENV])) {

    /**
     * Capsule manager providing expressive query builder, ActiveRecord style ORM and schema builder
     */
    $capsule = new Illuminate\Database\Capsule\Manager;

    /**
     * Connection for Capsule manager
     */
    $capsule->addConnection([
        'driver'    => $db[ENV]['driver'],
        'host'      => $db[ENV]['host'],
        'database'  => $db[ENV]['database'],
        'username'  => $db[ENV]['username'],
        'password'  => $db[ENV]['password'],
        'charset'   => $db[ENV]['charset'],
        'collation' => $db[ENV]['collation'],
        'prefix'    => $db[ENV]['prefix'],
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
    'Cache.SerializerPath' => SRC_PATH . '/Cache',
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