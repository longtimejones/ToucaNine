<?php
namespace ToucaNine\View;

/**
 * View Interface
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   View
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
interface ViewInterface
{
    /**
     * Renders template
     *
     * @param string $template Template file
     * @param array $data Template data
     * @param bool $return Returns rendered template
     * @param bool $tidy Performs clean and repair on rendered template
     *
     * @return void
     *
     * @access public
     */
    public function render($template, array $data = array(), $return = false, $tidy = TIDY);
}

/**
 * END ToucaNine/View/ViewInterface.php
 */