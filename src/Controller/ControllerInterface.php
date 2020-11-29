<?php
namespace ToucaNine\Controller;

/**
 * Controller Interface
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Controller
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
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