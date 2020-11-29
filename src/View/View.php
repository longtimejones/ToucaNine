<?php
namespace ToucaNine\View;

/**
 * View
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   View
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */
final class View implements ViewInterface
{
    /**
     * Template data
     *
     * @var array
     */
    private $_stack = array();

    /**
     * Tidy configuration
     *
     * @var array
     */
    private $_tidy_config = array(
        'hide-comments'       => true,
        'indent'              => true,
        'indent-cdata'        => true,
        'indent-spaces'       => 4,
        'literal-attributes'  => true,
        'lower-literals'      => true,
        'new-blocklevel-tags' => 'article,header,footer,section,nav',
        'new-inline-tags'     => 'video,audio,canvas,ruby,rt,rp',
        'preserve-entities'   => true,
        'quote-ampersand'     => true,
        'quote-marks'         => true,
        'quote-nbsp'          => true,
        'tidy-mark'           => false,
        'wrap'                => 0,
    );

    /**
     * Assigns data to template
     *
     * @param mixed $key Name
     * @param mixed $var Data
     *
     * @return void
     *
     * @access public
     */
    public function assign($key, $var = null)
    {
        $this->_stack[$key] = $var;
    }

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
    public function render($template, array $data = array(), $return = false, $tidy = TIDY)
    {
        /**
         * Import template data to current scope
         */
        foreach (array($data, $this->_stack) as $vars)
            if (empty($vars) === false)
                extract($vars, EXTR_SKIP);

        /**
         * Start output buffer
         */
        ob_start();

        /**
         * Include the template
         */
        include TPL_PATH . DS . $template;

        /**
         * Return output buffer
         */
        if ($return === true) {
            if ($tidy === true)
                return tidy_repair_string(ob_get_clean(), $this->_tidy_config, 'utf8');
            return ob_get_clean();
        }

        /**
         * Flush output buffer
         */
        if ($tidy === true)
            echo tidy_repair_string(ob_get_clean(), $this->_tidy_config, 'utf8');
        else
            ob_end_flush();
    }
}

/**
 * END ToucaNine/View/View.php
 */