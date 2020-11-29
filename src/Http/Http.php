<?php
namespace ToucaNine\Http;

/**
 * HTTP Component
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   HTTP
 *
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */
final class Http implements HttpInterface
{
    /**
     * HTTP status codes
     *
     * @var array
     */
    private $_http_status_codes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authorative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    /**
     * Request object
     *
     * @var \Nette\Http\RequestFactory
     */
    public $request;

    /**
     * Response object
     *
     * @var \Nette\Http\IResponse
     */
    public $response;

    /**
     * Dependency constructor for Request and Response objects
     *
     * @param object $request \Nette\Http\RequestFactory
     * @param object $response \Nette\Http\IResponse
     *
     * @return void
     *
     * @access public
     */
    public function __construct(\Nette\Http\RequestFactory $request, \Nette\Http\IResponse $response)
    {
        $this->request  = $request->createHttpRequest();
        $this->response = $response;
    }

    /**
     * Is HTTP method AJAX
     *
     * @return bool
     *
     * @access public
     */
    public function isAjax()
    {
        return ($this->request->isAjax());
    }

    /**
     * Is HTTP user-agent bot (web crawler robot)
     *
     * @return bool
     *
     * @access public
     */
    public function isBot()
    {
        return (
            strpos($this->request->getHeader('User-Agent'), 'bot') !== false OR
            strpos($this->request->getHeader('User-Agent'), 'googlebot') !== false OR
            strpos($this->request->getHeader('User-Agent'), 'msnbot') !== false OR
            strpos($this->request->getHeader('User-Agent'), 'slurp') !== false OR
            strpos($this->request->getHeader('User-Agent'), 'spider') !== false OR
            strpos($this->request->getHeader('User-Agent'), 'yahoo!') !== false
        );
    }

    /**
     * Is HTTP method DELETE
     *
     * @return bool
     *
     * @access public
     */
    public function isDelete()
    {
        return $this->request->isMethod('DELETE');
    }

    /**
     * Is HTTP method GET
     *
     * @return bool
     *
     * @access public
     */
    public function isGet()
    {
        return $this->request->isMethod('GET');
    }

    /**
     * Is HTTP method HEAD
     *
     * @return bool
     *
     * @access public
     */
    public function isHead()
    {
        return $this->request->isMethod('HEAD');
    }

    /**
     * Is HTTP method POST
     *
     * @return bool
     *
     * @access public
     */
    public function isPost()
    {
        return $this->request->isMethod('POST');
    }

    /**
     * Is HTTP method PUT
     *
     * @return bool
     *
     * @access public
     */
    public function isPut()
    {
        return $this->request->isMethod('PUT');
    }

    /**
     * Performs a permanently HTTP header 301 redirect
     *
     * @param string $path Page location path
     *
     * @return void
     *
     * @throws \InvalidArgumentException if location path is invalid
     *
     * @access public
     */
    public function redirectHard($path)
    {
        if (!empty($path) && is_string($path))
            $this->response->redirect($path, 301);
        else
            throw new \InvalidArgumentException('A permanently HTTP header 301 redirect requires a valid location path.');
    }

    /**
     * Performs a temporarily HTTP header 302 redirect
     *
     * @param string $path Page location path
     *
     * @return void
     *
     * @throws \InvalidArgumentException if location path is invalid
     *
     * @access public
     */
    public function redirectSoft($path)
    {
        if (!empty($path) && is_string($path))
            $this->response->redirect($path, 302);
        else
            throw new \InvalidArgumentException('A temporarily HTTP header 302 redirect requires a valid location path.');
    }

    /**
     * Sets HTTP header status
     *
     * @param int $status_code HTTP status code
     *
     * @return void
     *
     * @throws \InvalidArgumentException if status code is invalid
     *
     * @access public
     */
    public function setHttpStatus($status_code)
    {
        if (isset($this->_http_status_codes[$status_code]))
            header("HTTP/1.1 {$status_code} {$this->_http_status_codes[$status_code]}", true, $status_code);
        else
            throw new \InvalidArgumentException('An invalid HTTP status code was detected.');
    }

    /**
     * Throws a HTTP header 404 error
     *
     * @return void
     *
     * @access public
     */
    public function setPageError()
    {
        $this->setHttpStatus(404);
    }
}

/**
 * END ToucaNine/Http/Http.php
 */