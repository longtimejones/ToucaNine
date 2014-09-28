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

/**
 * Directory separator
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * File extension
 */
define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));

/**
 * Project path
 */
define('PRO_PATH', realpath(__DIR__ . DS . '..' . DS . '..'));

/**
 * Source path
 */
define('SRC_PATH', PRO_PATH . DS . 'src');

/**
 * Application path
 */
define('APP_PATH', PRO_PATH . DS . 'app');

/**
 * Template path
 */
define('TPL_PATH', APP_PATH . DS . 'View');

/**
 * Memory setter
 */
define('TOUCANINE_SET_MEMORY', memory_get_usage());

/**
 * Time setter
 */
define('TOUCANINE_SET_TIME', microtime(true));

/**
 * Autoloading
 */
require PRO_PATH . DS . 'vendor' . DS . 'autoload.php';

/**
 * Dependency injection
 */
$dependency = new Dependency(array(
    'ApplicationInterface' => 'ToucaNine\Application\Application',
    'ControllerInterface'  => 'ToucaNine\Controller\Controller',
    'FactoryInterface'     => 'ToucaNine\Factory\Factory',
    'HelperInterface'      => 'ToucaNine\Helper\Helper',
    'HttpInterface'        => 'ToucaNine\Http\Http',
    'IResponse'            => '\Nette\Http\Response',
    'ModelInterface'       => 'ToucaNine\Model\Model',
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
Exception\ErrorException::setHttp($container->get('ToucaNine\Http\Http'));
Exception\ErrorException::setView($container->get('ToucaNine\View\View'));

/**
 * Application configuration
 */
include APP_PATH . DS . 'Config' . EXT;

/**
 * Application execution
 */
$app = $container->get('ToucaNine\Application\Application');

/**
 * END ToucaNine/Bootstrapper.php
 */