<?php
namespace ToucaNine\Application;

/**
 * Application Interface
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
interface ApplicationInterface
{
    /**
     * Maps the route configuration
     *
     * @return void
     *
     * @access public
     */
    public function route();
    
    /**
     * Serves the route based upon the requested URI
     *
     * @return void
     *
     * @access public
     */
    public function dispatch();
}

/**
 * END ToucaNine/Application/ApplicationInterface.php
 */