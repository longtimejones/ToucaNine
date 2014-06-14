<?php
namespace App\Model;
use ToucaNine\Model\Model;

/**
 * Default Model
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Model
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
class Page extends Model
{
    public function getTestData($stranger)
    {
        return $this->helper('PDO')->select('SELECT * FROM test WHERE guest = :stranger', array(':stranger' => $stranger));
    }
}

/**
 * END App/Model/Page.php
 */