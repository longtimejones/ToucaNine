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
final class Sanitize
{
    /**
     * Sanitizes for valid email characters
     *
     * @param mixed $var Value to filter
     *
     * @return string
     *
     * @access public
     */
    public function email($var)
    {
        return filter_var($var, FILTER_SANITIZE_EMAIL);
    }
    
    /**
     * Sanitizes to URL-encoded string
     *
     * @param mixed $var Value to filter
     *
     * @return string
     *
     * @access public
     */
    public function encoded($var)
    {
        return filter_var($var, FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_HIGH);
    }
    
    /**
     * Sanitizes to float
     *
     * @param mixed $var Value to filter
     *
     * @return float
     *
     * @access public
     */
    public function float($var)
    {
        return floatval(filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT));
    }
    
    /**
     * Sanitizes to integer
     *
     * @param mixed $var Value to filter
     *
     * @return int
     *
     * @access public
     */
    public function integer($var)
    {
        return intval(filter_var($var, FILTER_SANITIZE_NUMBER_INT));
    }
    
    /**
     * Sanitizes to clean string
     *
     * @param mixed $var Value to filter
     *
     * @return string
     *
     * @access public
     */
    public function string($var)
    {
        return filter_var($var, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }
    
    /**
     * Sanitizes for special characters to HTML entities
     *
     * @param mixed $var Value to filter
     *
     * @return string
     *
     * @access public
     */
    public function specialchars($var)
    {
        return filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    /**
     * Sanitizes for valid URL characters
     *
     * @param mixed $var Value to filter
     *
     * @return string
     *
     * @access public
     */
    public function url($var)
    {
        return filter_var($var, FILTER_SANITIZE_URL);
    }
}

/**
 * END App/Helper/Sanitize.php
 */