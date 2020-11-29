<?php
namespace ToucaNine\Factory;

/**
 * Factory Interface
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Factory
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */
interface FactoryInterface
{

    /**
     * Service Locator for Application Controller
     *
     * @param string $class_name Controller class name
     *
     * @return object
     *
     * @access public
     */
    public function getController($class_name);

    /**
     * Service Locator for Application Helper
     *
     * @param string $class_name Helper class name
     *
     * @return object
     *
     * @access public
     */
    public function getHelper($class_name);

    /**
     * Service Locator for Application Model
     *
     * @param string $class_name Model class name
     *
     * @return object
     *
     * @access public
     */
    public function getModel($class_name);
}

/**
 * END ToucaNine/Factory/FactoryInterface.php
 */