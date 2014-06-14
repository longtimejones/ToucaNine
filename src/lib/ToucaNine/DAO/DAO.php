<?php
namespace ToucaNine\DAO;

/**
 * DAO
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   DAO
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
interface DAO
{
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
    public function select($sql, array $params = array());
    
    /**
     * Adds data
     *
     * @param string $entity SQL entity
     * @param array $params Parameters applying to placeholders
     *
     * @return bool
     *
     * @access public
     */
    public function insert($entity, array $params = array());
    
    /**
     * Modifies data
     *
     * @param string $entity SQL entity
     * @param array $params Parameters applying to placeholders
     *
     * @return bool
     *
     * @access public
     */
    public function update($entity, array $params = array());
    
    /**
     * Removes data
     *
     * @param string $entity SQL entity
     * @param array $params Parameters applying to placeholders
     *
     * @return bool
     *
     * @access public
     */
    public function delete($entity, array $params = array());
}

/**
 * END App/Helper/DAO.php
 */