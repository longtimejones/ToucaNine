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
 * Environment mode
 */
define('ENV', 'test');

/**
 * Debugging state
 */
define('DEBUG', (ENV == 'test' ? true : false));

/**
 * Error reporting level
 */
error_reporting((ENV == 'test' ? E_ALL ^ E_DEPRECATED ^ E_NOTICE | E_STRICT : 0));

/**
 * Database information
 */
$db = array(
    'prod' => array(
        'host' => '',
        'port' => '',
        'user' => '',
        'pswd' => '',
        'name' => '',
        'flag' => '',
    ),
    'stage' => array(
        'host' => '',
        'port' => '',
        'user' => '',
        'pswd' => '',
        'name' => '',
        'flag' => '',
    ),
    'test' => array(
        'host' => 'localhost',
        'port' => '',
        'user' => 'root',
        'pswd' => '',
        'name' => '',
        'flag' => '',
    ),
);

/**
 * Database settings
 */
define('DB_HOST', $db[ENV]['host']);
define('DB_PORT', $db[ENV]['port']);
define('DB_USER', $db[ENV]['user']);
define('DB_PSWD', $db[ENV]['pswd']);
define('DB_NAME', $db[ENV]['name']);
define('DB_FLAG', $db[ENV]['flag']);

/**
 * Tidy HTML repair setting
 */
define('TIDY', false);

/**
 * END app/Config.php
 */