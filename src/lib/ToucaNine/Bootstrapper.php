<?php
namespace ToucaNine;
use ToucaNine\IoC\Container, ToucaNine\IoC\Dependency;

/**
 * Bootstrapper
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Bootstrapper
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */

define('DS', DIRECTORY_SEPARATOR);
define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));
define('SYS_PATH', realpath(__DIR__ . DS . '..' . DS . '..'));
define('LIB_PATH', SYS_PATH . DS . 'lib');
define('APP_PATH', SYS_PATH . DS . 'app');
define('TPL_PATH', APP_PATH . DS . 'View');
define('TOUCANINE_SET_MEMORY', memory_get_usage());
define('TOUCANINE_SET_TIME', microtime(true));

/**
 * Application configuration
 */
include APP_PATH . DS . 'Config' . EXT;

/**
 * Core libraries
 */
foreach (array('Loader', 'Utils') as $file)
    require LIB_PATH . DS . __NAMESPACE__ . DS . $file . EXT;

/**
 * Autoloading libraries
 */
$loader = new Loader;

/**
 * Dependency injection
 */
$dependency = new Dependency(array(
    'ApplicationInterface' => 'ToucaNine\Application\Application',
    'ControllerInterface'  => 'ToucaNine\Controller\Controller',
    'FactoryInterface'     => 'ToucaNine\Factory\Factory',
    'HelperInterface'      => 'ToucaNine\Helper\Helper',
    'ModelInterface'       => 'ToucaNine\Model\Model',
    'RequestInterface'     => 'ToucaNine\Request\Request',
    'ViewInterface'        => 'ToucaNine\View\View',
));

/**
 * Dependency container
 */
$container = new Container($dependency);

/**
 * Shutdown register
 */
register_shutdown_function(array(
    'ToucaNine\Exception\ErrorException',
    'handleShutdown'
));

/**
 * Error handler
 */
set_error_handler(array(
    'ToucaNine\Exception\ErrorException',
    'handleError'
), E_ALL ^ E_DEPRECATED ^ E_NOTICE | E_STRICT);

/**
 * Exception handler
 */
set_exception_handler(array(
    'ToucaNine\Exception\ErrorException',
    'handleException'
));

/**
 * Dependency setter
 */
Exception\ErrorException::setRequest($container->get('ToucaNine\Request\Request'));
Exception\ErrorException::setView($container->get('ToucaNine\View\View'));

/**
 * Application
 */
$app = $container->get('ToucaNine\Application\Application');

/**
 * END ToucaNine/Bootstrapper.php
 */