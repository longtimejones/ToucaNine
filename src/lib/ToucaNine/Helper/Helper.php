<?php
namespace ToucaNine\Helper;
use ToucaNine\Factory\FactoryInterface;

/**
 * Helper
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Helper
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
abstract class Helper implements HelperInterface
{
    use \ToucaNine\Overload;
    
    /**
     * Factory object
     *
     * @var \ToucaNine\Factory\FactoryInterface
     */
    protected $factory;
    
    /**
     * Dependency constructor for Factory object
     *
     * @param object $factory \ToucaNine\Factory\FactoryInterface
     *
     * @return void
     *
     * @access public
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
}

/**
 * END ToucaNine/Helper/Helper.php
 */