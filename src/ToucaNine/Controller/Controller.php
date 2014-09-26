<?php
namespace ToucaNine\Controller;
use ToucaNine\Factory\FactoryInterface, ToucaNine\Http\HttpInterface, ToucaNine\View\ViewInterface;

/**
 * Controller
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Controller
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
abstract class Controller implements ControllerInterface
{
    use \ToucaNine\Overload;

    /**
     * Factory object
     *
     * @var \ToucaNine\Factory\FactoryInterface
     */
    protected $factory;

    /**
     * Http object
     *
     * @var \ToucaNine\Http\HttpInterface
     */
    protected $http;

    /**
     * View object
     *
     * @var \ToucaNine\View\ViewInterface
     */
    protected $view;

    /**
     * Dependency constructor for Factory, Http and View objects
     *
     * @param object $factory \ToucaNine\Factory\FactoryInterface
     * @param object $http \ToucaNine\Http\HttpInterface
     * @param object $view \ToucaNine\View\ViewInterface
     *
     * @return void
     *
     * @access public
     */
    public function __construct(FactoryInterface $factory, HttpInterface $http, ViewInterface $view)
    {
        $this->factory = $factory;
        $this->http    = $http;
        $this->view    = $view;
    }

    /**
     * HMVC-alike controller request
     *
     * @param string $method Controller method
     * @param array $segments Method arguments
     *
     * @return void
     *
     * @throws \BadMethodCallException if controller method is unreachable
     *
     * @access public
     */
    public function invoke($method, array $segments = array())
    {
        /**
         * Callable class methods
         */
        $class_methods = get_class_methods($this);

        /**
         * Are there any controller methods?
         */
        if (is_array($class_methods)) {

            /**
             * Filter off private controller methods
             */
            $class_methods = preg_grep('/^[^_](.+)$/', $class_methods);

            /**
             * Is method callable?
             */
            if (in_array($method, $class_methods)) {

                /**
                 * Call controller method with segment parameters
                 */
                call_user_func_array(
                    array($this, $method),
                    $segments
                );

            /**
             * Undefined method
             */
            } else {

                throw new \BadMethodCallException("Controller method {$method} doesn't exist or isn't callable.");

            }

        /**
         * None controller methods
         */
        } else {

            throw new \BadMethodCallException('None of the controller methods are callable.');

        }
    }
}

/**
 * END ToucaNine/Controller/Controller.php
 */