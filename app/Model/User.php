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
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
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