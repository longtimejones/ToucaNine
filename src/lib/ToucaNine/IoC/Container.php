<?php
namespace ToucaNine\IoC;

/**
 * Container
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Container
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Container
{
    /**
     * Dependency injection
     *
     * @var object \ToucaNine\IoC\Dependency
     *
     * @access private
     */
    private $_dependency;
    
    /**
     * Container object mapping
     *
     * @var object
     *
     * @access private
     */
    private $_registry = [];
    
    /**
     * Constructor
     *
     * @param \ToucaNine\IoC\Dependency
     *
     * @return void
     *
     * @access public
     */
    public function __construct(Dependency $dependency)
    {
        $this->_dependency = $dependency;
        $this->_dependency->setContainer($this);
    }
    
    /**
     * Inverses class object using reflection
     *
     * @param string $class_name Namespace class name
     *
     * @return object
     *
     * @access public
     *
     * @throws \ReflectionClassException
     */
    public function get($class_name)
    {
        if (isset($this->_registry[$class_name]))
            return $this->_registry[$class_name];
        if (get_class() == $class_name)
            return $this->_registry[$class_name] = $this;
        return $this->_registry[$class_name] = $this->_dependency->resolve(new \ReflectionClass($class_name));
    }
}

/**
 * END ToucaNine/IoC/Container.php
 */