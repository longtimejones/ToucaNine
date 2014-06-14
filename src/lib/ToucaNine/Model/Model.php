<?php
namespace ToucaNine\Model;
use ToucaNine\Factory\FactoryInterface;

/**
 * Model
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Model
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
abstract class Model implements ModelInterface
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
 * END ToucaNine/Model/Model.php
 */