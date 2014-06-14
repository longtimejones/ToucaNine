<?php
namespace ToucaNine;
use ToucaNine\IoC\Container;

/**
 * Core
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Overload
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
trait Overload
{
    /**
     * Method overloading
     *
     * @param string $name Name of method triggered
     * @param array $arguments Parameters passed to method
     *
     * @return object
     *
     * @access public
     */
    public function __call($name, $arguments)
    {
        $getter = 'get' . ucfirst($name);
        $setter = null;
        if (in_array($name, array('controller', 'helper', 'model'))) {
            $setter = $this->factory->$getter($arguments[0]);
            if ($setter === null)
                throw new \InvalidArgumentException("{$getter} library for {$arguments[0]} does not exist");
            return $setter;
        }
        if (empty($arguments[0]))
            $arguments[0] = 'null';
        throw new \InvalidArgumentException("{$getter} is not a valid library for {$arguments[0]}");
    }
}

/**
 * END ToucaNine/Overload.php
 */