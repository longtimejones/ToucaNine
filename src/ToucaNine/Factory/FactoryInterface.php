<?php
namespace ToucaNine\Factory;

/**
 * Factory Interface
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
interface FactoryInterface
{

    /**
     * Service Locator for Application Controller
     *
     * @param string $class_name Controller class name
     *
     * @return object
     *
     * @access public
     */
    public function getController($class_name);
    
    /**
     * Service Locator for Application Helper
     *
     * @param string $class_name Helper class name
     *
     * @return object
     *
     * @access public
     */
    public function getHelper($class_name);
    
    /**
     * Service Locator for Application Model
     *
     * @param string $class_name Model class name
     *
     * @return object
     *
     * @access public
     */
    public function getModel($class_name);
}

/**
 * END ToucaNine/Factory/FactoryInterface.php
 */