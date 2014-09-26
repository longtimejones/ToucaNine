<?php
namespace ToucaNine\Exception;
use ToucaNine\Http\HttpInterface, ToucaNine\View\ViewInterface;

/**
 * Error Exception
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Exception
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class ErrorException extends \ErrorException implements ErrorExceptionInterface
{
    /**
     * Http object
     *
     * @var \ToucaNine\Http\HttpInterface
     *
     * @static
     */
    private static $_http;

    /**
     * View object
     *
     * @var \ToucaNine\View\ViewInterface
     *
     * @static
     */
    private static $_view;

    /**
     * Debugs the error or exception raised
     *
     * @return void
     *
     * @access public
     */
    public function debug()
    {
        static::$_http->setHttpStatus(500);
        if (defined('DEBUG') && DEBUG === true) {
            $heading = $this->_getErrorType($this->code);
            $message = $this->message;
            if ($heading === false) {
                $exception_type = $this->_getExceptionType($this->message);
                if ($exception_type === false) {
                    $heading = 'Caught unknown exception';
                } else {
                    $heading = "Caught {$exception_type}";
                    $message = str_replace("{$exception_type}: ", '', $message);
                }
            }
            static::$_view->assign('heading', $heading);
            static::$_view->assign('message', $message);
            static::$_view->assign('file', $this->file);
            static::$_view->assign('line', $this->line);
            static::$_view->assign('script', $this->_getLineContents($this->file, $this->line));
            static::$_view->render('debug.html');
        } else {
            static::$_view->assign('page_title', 'An error has occurred');
            static::$_view->assign('page_content', 'We apologize for the inconvenience, but the system was unable to carry out your request.');
            static::$_view->render('template.html');
        }
        exit;
    }

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
    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        try {
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
        } catch (ErrorException $e) {
            $e->debug();
        }
    }

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
    public static function handleException($e)
    {
        if ($e instanceof ErrorException) {
            $e->debug();
        } else {
            try {
                throw new ErrorException(get_class($e) . ': ' . $e->getMessage(), $e->getCode(), 0, $e->getFile(), $e->getLine());
            } catch (ErrorException $e) {
                $e->debug();
            }
        }
    }

    /**
     * Handles execution errors on shutdown
     *
     * @return void
     *
     * @access public
     *
     * @static
     */
    public static function handleShutdown()
    {
        $last_error = error_get_last();
        if ($last_error !== null && $last_error['type'] != E_DEPRECATED && $last_error['type'] != E_NOTICE) {
            ErrorException::handleError(
                $last_error['type'],
                $last_error['message'],
                $last_error['file'],
                $last_error['line']
            );
        }
    }

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
    public static function setHttp(HttpInterface $http)
    {
        static::$_http = $http;
    }

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
    public static function setView(ViewInterface $view)
    {
        static::$_view = $view;
    }

    /**
     * Gets type of error
     *
     * @param int $code Level of the error raised
     *
     * @return string|bool
     *
     * @access private
     */
    private function _getErrorType($code)
    {
        switch ($code) {
            case E_ERROR:
                return 'Fatal run-time error';
                break;
            case E_WARNING:
                return 'Run-time warning';
                break;
            case E_PARSE:
                return 'Compile-time parse error';
                break;
            case E_NOTICE:
                return 'Run-time notice';
                break;
            case E_CORE_ERROR:
                return 'Fatal error occurred during initial startup';
                break;
            case E_CORE_WARNING:
                return 'Warning occurred during initial startup';
                break;
            case E_CORE_ERROR:
                return 'Fatal compile-time error';
                break;
            case E_CORE_WARNING:
                return 'Compile-time warning';
                break;
            case E_USER_ERROR:
                return 'User-generated error message';
                break;
            case E_USER_WARNING:
                return 'User-generated warning message';
                break;
            case E_USER_NOTICE:
                return 'User-generated notice message';
                break;
            case E_STRICT:
                return 'Change suggested for best interoperability and forward compatibility';
                break;
            case E_RECOVERABLE_ERROR:
                return 'Catchable fatal error';
                break;
            case E_DEPRECATED:
                return 'Run-time notice';
                break;
            case E_USER_DEPRECATED:
                return 'User-generated warning message';
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Gets type of exception
     *
     * @param string $message Error message
     *
     * @return string|bool
     *
     * @access private
     */
    private function _getExceptionType($message)
    {
        if (preg_match('/^([a-z]+):\s.+/i', $message, $matches) !== false && count($matches) > 1)
            return $matches[1];
        return false;
    }

    /**
     * Gets line contents causing the error
     *
     * @param string $file Filename that the error was raised in
     * @param int $line Line number the error was raised at
     *
     * @return string
     *
     * @access private
     */
    private function _getLineContents($file, $line)
    {
        $file_contents = file($file);
        $line_contents = $file_contents[($line - 1)];
        $line_contents = trim($line_contents);
        $line_contents = highlight_string($line_contents, true);
        return $line_contents;
    }
}

/**
 * END ToucaNine/Exception/ErrorException.php
 */