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
class User extends Model
{
    /**
     * The database table in use
     *
     * @var string
     */
    protected $table = 'users';

    public function scopeByUsername($query, $username)
    {
        return $query->whereUsername($username);
    }
}

/**
 * END App/Model/User.php
 */