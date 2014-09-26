<?php
namespace ToucaNine\IoC;

/**
 * Dependency
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Dependency
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Dependency
{
    /**
     * Dependency injection
     *
     * @var object \ToucaNine\IoC\Container
     *
     * @access private
     */
    private $_container;

    /**
     * Interpret interfaces
     *
     * @var array
     *
     * @access private
     */
    private $_interpret = array();

    /**
     * Constructor
     *
     * @param array $interpret Interpreter for interfaces
     *
     * @return void
     *
     * @access public
     */
    public function __construct(array $interpret)
    {
        $this->_interpret = $interpret;
    }

    /**
     * Setter injection for Dependency container
     *
     * @param object $container \ToucaNine\IoC\Container
     *
     * @return void
     *
     * @access public
     */
    public function setContainer(Container $container)
    {
        $this->_container = $container;
    }

    /**
     * Resolves dependencies
     *
     * @param object $reflection \ReflectionClass
     *
     * @return object|bool
     *
     * @throws \LogicException
     *
     * @access public
     */
    public function resolve(\ReflectionClass $reflection)
    {
        try {
            $constructor  = $reflection->getConstructor();
            $dependencies = array();
            if ($constructor !== null)
                $dependencies = $constructor->getParameters();
            if (count($dependencies) > 0)
                return $reflection->newInstanceArgs($this->_inverse($dependencies));
            else
                return $reflection->newInstance();
        } catch (\Exception $e) {
            throw new \LogicException("Could not invoke dependency class {$class_name} with message: {$e->getMessage()}.", $e->getCode());
        }
        return false;
    }

    /**
     * Inverses dependencies
     *
     * @param array $dependencies Dependencies
     *
     * @return array
     *
     * @access private
     */
    private function _inverse(array $dependencies)
    {
		$objects = array();
		foreach ($dependencies as $dependency) {
            $dependency_class = $dependency->getClass();
            if ($dependency_class !== null) {
                $class_name       = $dependency_class->getName();
                $class_name_short = $dependency_class->getShortName();
                if ($dependency_class->isInterface())
                    if (isset($this->_interpret[$class_name_short]))
                        $class_name = $this->_interpret[$class_name_short];
                $objects[] = $this->_container->get($class_name);
            }
        }
		return $objects;
    }
}

/**
 * END ToucaNine/IoC/Dependency.php
 */