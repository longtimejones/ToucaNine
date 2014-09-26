<?php
namespace App\Helper;

/**
 * Profiling Helper
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Profiling
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Profiling
{
    /**
     * Gets application executing time and memory usage
     *
     * @return string
     *
     * @access public
     */
    public function application()
    {
        return sprintf('Page rendered in %.4f seconds using %.3f MB of memory.', $this->getExecutionTime(), $this->getMemoryUsage());
    }

    /**
     * Gets application executing time
     *
     * @return float
     *
     * @access public
     */
    public function getExecutionTime()
    {
        return (microtime(true) - TOUCANINE_SET_TIME);
    }

    /**
     * Gets application memory usage
     *
     * @return int
     *
     * @access public
     */
    public function getMemoryUsage()
    {
        return ((memory_get_peak_usage() - TOUCANINE_SET_MEMORY) / 1024 / 1024);
    }
}

/**
 * END App/Helper/Profiling.php
 */