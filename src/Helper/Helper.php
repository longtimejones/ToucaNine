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
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 *
 * @deprecated A helper has one purpose only, why it does not make any sense providing overload
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