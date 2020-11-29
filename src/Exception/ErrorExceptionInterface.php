<?php
namespace ToucaNine\Exception;
use ToucaNine\Http\HttpInterface, ToucaNine\View\ViewInterface;

/**
 * Description
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 */
interface ErrorExceptionInterface
{
    /**
     * Debugs the error or exception raised
     *
     * @return void
     *
     * @access public
     */
    public function debug();

    /**
     * Handles errors during runtime
     *
     * @param int $errno Level of the error raised
     * @param string $errstr Error message
     * @param string $errfile Filename that the error was raised in
     * @param int $errline Line number the error was raised at
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function handleError($errno, $errstr, $errfile, $errline);

    /**
     * Handles all kinds of exceptions
     *
     * @param object $e \Exception
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function handleException($e);

    /**
     * Handles execution errors on shutdown
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function handleShutdown();

    /**
     * Dependency setter for Http object
     *
     * @param \ToucaNine\Http\HttpInterface
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function setHttp(HttpInterface $http);

    /**
     * Dependency setter for View object
     *
     * @param \ToucaNine\View\ViewInterface
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function setView(ViewInterface $view);
}

/**
 * END ToucaNine/Exception/ErrorExceptionInterface.php
 */