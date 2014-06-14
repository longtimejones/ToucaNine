<?php
namespace ToucaNine\Application;
use ToucaNine\Factory\FactoryInterface, ToucaNine\Request\RequestInterface, ToucaNine\View\ViewInterface;

/**
 * Application
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Application
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Application implements ApplicationInterface
{
    use \ToucaNine\Overload;
    
    /**
     * Factory object
     *
     * @var \ToucaNine\Factory\FactoryInterface
     */
    protected $factory;
    
    /**
     * Request object
     *
     * @var \ToucaNine\Request\RequestInterface
     */
    protected $request;

    /**
     * Detected routes
     *
     * @var array
     */
    protected $routes = array();
    
    /**
     * View object
     *
     * @var \ToucaNine\View\ViewInterface
     */
    protected $view;
    
    /**
     * Dependency constructor for Factory, Request and View objects
     *
     * @param object $factory \ToucaNine\Factory\FactoryInterface
     * @param object $request \ToucaNine\Request\RequestInterface
     * @param object $view \ToucaNine\View\ViewInterface
     *
     * @return void
     *
     * @access public
     */
    public function __construct(FactoryInterface $factory, RequestInterface $request, ViewInterface $view)
    {
        $this->factory = $factory;
        $this->request = $request;
        $this->view    = $view;
    }
    
    /**
     * Maps the route configuration
     *
     * @return void
     *
     * @access public
     */
    public function route()
    {
        /**
         * Route's argument list
         */
        $args = func_get_args();
        
        /**
         * Anonymous function
         */
        $func = false;
        
        /**
         * Route lacks configuration
         */
        if (isset($args[0]) === false)
            throw new \InvalidArgumentException('The given route lacks a configuration.');
            
        /**
         * Invalid route detected
         */
        if (is_string($args[0]) === false)
            throw new \InvalidArgumentException('The given route is invalid.');
            
        /**
         * Controller route detected
         */
        if (is_array($args[1])) {
            
            /**
             * Controller route lacks controller
             */
            $controller = current($args[1]);
            if (empty($controller))
                throw new \InvalidArgumentException('The controller for the given route is invalid.');
                
            /**
             * Controller route lacks method
             */
            $method = next($args[1]);
            if (empty($method))
                throw new \InvalidArgumentException('The method for the given route is invalid.');
                
            /**
             * Set controller route
             */
            $this->routes[$args[0]]['controller'] = array_values($args[1]);
            
        /**
         * Closure route detected
         */
        } elseif (is_object($args[1])) {
            
            /**
             * Reference to anonymous function
             */
            $func =& $args[1];
            
            /**
             * Set closure route
             */
            $this->routes[$args[0]]['func'] = $func;
            
        /**
         * Unknown route detected
         */
        } else {
            
            throw new \ErrorException('Unknown route type');
            
        }
    }
    
    /**
     * Serves the route based upon the requested URI
     *
     * @return void
     *
     * @access public
     */
    public function dispatch()
    {
        /**
         * Operational URI
         */
        $subject = $this->request->getHttpMethod() . ' ' . $this->request->getUri();

        /**
         * Loop over mapped routes
         */
        foreach ($this->routes as $pattern => $route) {
            
            /**
             * Pattern given the route
             */
            $pattern = '/^' . str_replace('/', '\/', $pattern) . '\/?$/i';
            
            /**
             * Perform a match towards the route
             */
            if (preg_match($pattern, $subject, $args) !== false && $args[0] !== null) {
                
                /**
                 * Sanitize input
                 */
                $args = array_map('trim', $args);
                $args = array_map('urldecode', $args);
                $args = filter_var_array($args, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
                
                /**
                 * Grab the matches (segments)
                 */
                $this->request->setUriSegments(array_slice($args, 1, count($args), true));
                
                /**
                 * Requesting controller method
                 */
                if (isset($route['controller'])) {
                    
                    /**
                     * Route segments
                     */
                    foreach ($route['controller'] as $key => $component)
                        if (strpos($pattern, '(') !== false && strpos($component, '$') !== false)
                            $route['controller'][$key] = preg_replace($pattern, $component, $subject);

                    /**
                     * Call controller method
                     */
                    $controller = $this->controller($route['controller'][0])->invoke($route['controller'][1], array_slice($route['controller'], 2));
                    break;
                
                /**
                 * Requesting anonymous function, closure
                 */
                } elseif (isset($route['func']) && is_object($route['func'])) {
                    
                    /**
                     * Call anonymous function, closure
                     */
                    $route['func']($this);
                    break;
                
                /**
                 * Requesting undefined method
                 */
                } else {
                    
                    throw new \ErrorException("Overloaded method <em>{$route['func']}</em> couldn't be found.");
                
                }
            }
        }
    }
}

/**
 * END ToucaNine/Application/Application.php
 */