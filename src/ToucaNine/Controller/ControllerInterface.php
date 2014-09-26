<?php
namespace ToucaNine\Controller;

/**
 * Controller Interface
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
interface ControllerInterface
{
    /**
     * HMVC-alike controller request
     *
     * @param string $method Controller method
     * @param array $segments Method arguments
     *
     * @return void
     *
     * @access public
     */
    public function invoke($method, array $segments = array());
}

/**
 * END ToucaNine/Controller/ControllerInterface.php
 */