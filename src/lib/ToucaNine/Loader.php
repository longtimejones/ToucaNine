<?php
namespace ToucaNine;

/**
 * Loader
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Loader
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Loader
{
    /**
     * Constructor
     *
     * Registers class method as autoload handler
     *
     * @param bool $prepend Append or prepend handler to spl stack
     *
     * @return void
     *
     * @throws \Exception If method cannot be registered as autoload handler
     *
     * @access public
     */
    public function __construct($prepend = false)
    {
        spl_autoload_register(array($this, '_loadClassByNamespace'), true, $prepend);
    }
    
    /**
     * Loads class given the namespace and/or name of class
     *
     * @param string $class_name Namespace class name
     *
     * @return bool
     *
     * @access private
     */
    private function _loadClassByNamespace($class_name)
    {
        /**
         * In case class is already defined
         */
        if (class_exists($class_name, false))
            return true;
        
        /**
         * Normalizes any namespace
         */
        $rel_path = str_replace('\\', DS, $class_name);
        $rel_path = trim($rel_path, DS);
        
        /**
         * Attempts to load the class from the current source level
         */
        $abs_path = realpath(dirname(__FILE__) . '/../' . $rel_path . EXT);
        /**
         *
        print '<pre>';
        print (dirname(__FILE__) . '/../' . $rel_path . EXT);
        print '</pre>';
        /**
         */
        if ($abs_path !== false) {
            require $abs_path;
            return true;
        }
        
        /**
         * Attempts to load the class from other source level
         */
        $abs_path = realpath(dirname(__FILE__) . '/../' . $rel_path . DS . $rel_path . EXT);
        /**
         *
        print '<pre>';
        print (dirname(__FILE__) . '/../' . $rel_path . DS . $rel_path . EXT);
        print '</pre>';
        /**
         */
        if ($abs_path !== false) {
            require $abs_path;
            return true;
        }
        
        /**
         * Attempts to find and load the class from other source levels
         */
        return $this->_findClassByNamespace($rel_path);
    }
    
    /**
     * Searches for class given the namespace and/or name of class
     *
     * @param string $class_name Namespace class name
     *
     * @return bool
     *
     * @access private
     */
    private function _findClassByNamespace($class_name)
    {
        $abs_path = realpath(APP_PATH . '/../' . $this->_getNamespaceToLower($class_name) . EXT);
        /**
         *
        print '<pre>';
        print (APP_PATH . '/../' . $this->_getNamespaceToLower($class_name) . EXT);
        print '</pre>';
        /**
         */
        if ($abs_path !== false) {
            require $abs_path;
            return true;
        }
        
        return false;
    }
    
    /**
     * Returns namespace of class lowercased
     *
     * @param string $class_name Namespace class name
     *
     * @return void
     *
     * @access private
     */
    private function _getNamespaceToLower($class_name)
    {
        if (($pos = strpos($class_name, '/')) !== false && $pos > 0) {
            $namespace  = substr($class_name, 0, $pos);
            $namespace  = strtolower($namespace);
            $class_name = $namespace . substr($class_name, $pos);
        }
        return $class_name;
    }
}

/**
 * END ToucaNine/Loader.php
 */