<?php
namespace App\Helper;
use ToucaNine\DAO\DAO;

/**
 * PDO
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   PDO
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class PDO implements DAO
{
    /**
     * Database handler
     *
     * @var bool|object
     */
    private $dbh = false;
    
    /**
     * Statement handler
     *
     * @var bool|object
     */
    private $sth = false;
    
    /**
     * Constructor establishing database connection
     *
     * @return void
     *
     * @access public
     */
    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PSWD, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    
    /**
     * Fetches data
     *
     * @param string $sql SQL statement to execute
     * @param array $params Parameters applying to placeholders
     *
     * @return bool|array
     *
     * @access public
     */
    public function select($sql, array $params = array())
    {
        if (empty($params)) {
            $this->sth = $this->dbh->query($sql);
        } else {
            $this->sth = $this->dbh->prepare($sql);
            if ($this->sth !== false)
                if ($this->sth->execute($params) === false)
                    return false;
        }
        if ($this->sth === false)
            return false;
        return $this->sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Gets single row column from result set
     *
     * @return string
     *
     * @access public
     */
    public function getColumn($column_number = 0)
    {
        return $this->sth->fetchColumn($column_number);
    }
    
    /**
     * Gets number of rows affected by last statement 
     *
     * @return int
     *
     * @access public
     */
    public function getRowsAffected()
    {
        return $this->sth->rowCount();
    }
}

/**
 * END App/Helper/PDO.php
 */