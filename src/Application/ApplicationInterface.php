<?php
namespace ToucaNine\Application;

/**
 * Application Interface
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Application
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
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