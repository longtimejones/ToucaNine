<?php
namespace App\Helper;

/**
 * PDO
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Filter
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Validate
{
    /**
     * Validates for valid email address
     *
     * @param mixed $var Value to filter
     *
     * @return bool|string
     *
     * @access public
     */
    public function email($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * Validates for valid IP address
     *
     * @param mixed $var Value to filter
     *
     * @return bool|string
     *
     * @access public
     */
    public function ip($var)
    {
        return filter_var($var, FILTER_VALIDATE_IP);
    }
    
    /**
     * Validates for valid float value
     *
     * @param mixed $var Value to filter
     *
     * @return bool|float
     *
     * @access public
     */
    public function float($var)
    {
        return filter_var($var, FILTER_VALIDATE_FLOAT);
    }
    
    /**
     * Validates for valid integer value
     *
     * @param mixed $var Value to filter
     *
     * @return bool|integer
     *
     * @access public
     */
    public function integer($var)
    {
        return filter_var($var, FILTER_VALIDATE_INT);
    }
    
    /**
     * Validates for valid URL
     *
     * @param mixed $var Value to filter
     *
     * @return bool|string
     *
     * @access public
     */
    public function url($var)
    {
        return filter_var($var, FILTER_VALIDATE_URL);
    }
}

/**
 * END App/Helper/Validate.php
 */