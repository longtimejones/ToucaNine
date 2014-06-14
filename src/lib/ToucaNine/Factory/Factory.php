<?php
namespace ToucaNine\Factory;
use ToucaNine\IoC\Container;

/**
 * Factory
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Factory
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Factory implements FactoryInterface
{
    /**
     * Container object
     *
     * @var \ToucaNine\IoC\Container
     */
    private $_container;
    
    /**
     * Dependency constructor for Container object
     *
     * @param object $container \ToucaNine\IoC\Container
     *
     * @return void
     *
     * @access public
     */
    public function __construct(Container $container)
    {
        $this->_container = $container;
    }

    /**
     * Service Locator for Application Controller
     *
     * @param string $class_name Controller class name
     *
     * @return object
     *
     * @access public
     */
    public function getController($class_name)
    {
        return $this->_container->get("\\App\\Controller\\{$class_name}");
    }
    
    /**
     * Service Locator for Application Helper
     *
     * @param string $class_name Helper class name
     *
     * @return object
     *
     * @access public
     */
    public function getHelper($class_name)
    {
        return $this->_container->get("\\App\\Helper\\{$class_name}");
    }
    
    /**
     * Service Locator for Application Model
     *
     * @param string $class_name Model class name
     *
     * @return object
     *
     * @access public
     */
    public function getModel($class_name)
    {
        return $this->_container->get("\\App\\Model\\{$class_name}");
    }
}

/**
 * END ToucaNine/Factory/Factory.php
 */