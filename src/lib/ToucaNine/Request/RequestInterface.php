<?php
namespace ToucaNine\Request;

/**
 * Request Interface
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Request
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
interface RequestInterface
{
    /**
     * Gets HTTP method (RESTful)
     *
     * @return string
     *
     * @access public
     */
    public function getHttpMethod();
    
    /**
     * Gets current URI
     *
     * @return string
     *
     * @access public
     */
    public function getUri();
}

/**
 * END ToucaNine/Request/RequestInterface.php
 */