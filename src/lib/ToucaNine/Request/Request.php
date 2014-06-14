<?php
namespace ToucaNine\Request;

/**
 * Request
 *
 * @package    ToucaNine
 * @subpackage Library
 * @category   Request
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
final class Request implements RequestInterface
{
    /**
     * Requested mixed
     *
     * @var bool|string
     */
    private $_http_method = false;
    
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
     * Detected HTTP user-agent
     *
     * @var bool|string
     */
    private $_http_user_agent = false;
    
    /**
     * Server variables stack
     *
     * @var array
     */
    private $_server_vars = array();

    /**
     * Query parameters in request URI
     *
     * @var array
     */
    private $_uri_query = array();
    
    /**
     * Segments in request URI
     *
     * @var array
     */
    private $_uri_segments = array();
    
    /**
     * Gets HTTP method (RESTful)
     *
     * @return string
     *
     * @access public
     */
    public function getHttpMethod()
    {
        if ($this->_http_method !== false)
            return $this->_http_method;
        $method = $this->getServerVar('REQUEST_METHOD', 'strtoupper');
        if ($method !== false)
            return $this->_http_method = $method;
        return $this->_http_method = 'GET';
    }
    
    /**
     * Gets HTTP user-agent
     *
     * @return string
     *
     * @access public
     */
    public function getHttpUserAgent()
    {
        if ($this->_http_user_agent !== false)
            return $this->_http_user_agent;
        return $this->_http_user_agent = $this->getServerVar('HTTP_USER_AGENT', 'strtolower');
    }
    
    /**
     * Gets $_SERVER variable
     *
     * @param string $element Web server element
     * @param string $string_function Name of function to manipulate string
     *
     * @return mixed
     *
     * @access public
     */
    public function getServerVar($element, $string_function = '')
    {
        $server_entry = false;
        if (isset($this->_server_vars[$element]))
            $server_entry = $this->_server_vars[$element];
        else if (isset($_SERVER[$element]))
            $server_entry = $this->_server_vars[$element] = $_SERVER[$element];
        if ($server_entry !== false && $string_function != '')
            $server_entry = $string_function($server_entry);
        return $server_entry;
    }
    
    /**
     * Gets current URI
     *
     * @return string
     *
     * @access public
     */
    public function getUri()
    {
        $uri = $this->getServerVar('PATH_INFO');
        if ($uri !== false && $uri !== null)
            return $uri;
        $uri = $this->getServerVar('REQUEST_URI');
        if ($uri !== false && $uri !== null) {
            $pos = strpos($uri, '?');
            if ($pos !== false) {
                parse_str(substr($uri, ($pos + 1)), $this->_uri_query);
                $uri = substr($uri, 0, $pos);
            }
            return $uri;
        }
        return '/';
    }
    
    /**
     * Gets URI query
     *
     * @param int $key Segment index key
     *
     * @return mixed
     *
     * @access public
     */
    public function getUriQuery($key)
    {
        if ($this->_uri_query[$key] !== null)
            return $this->_uri_query[$key];
        return null;
    }
    
    /**
     * Gets URI segment
     *
     * @param int $key Segment index key
     *
     * @return mixed
     *
     * @access public
     */
    public function getUriSegment($key = 1)
    {
        if ($this->_uri_segments[$key] !== null)
            return $this->_uri_segments[$key];
        return null;
    }
    
    /**
     * Sets HTTP header status
     *
     * @param int $status_code HTTP status code
     *
     * @return void
     *
     * @access public
     */
    public function setHttpStatus($status_code)
    {
        if (isset($this->_http_status_codes[$status_code]))
            header("HTTP/1.1 {$status_code} {$this->_http_status_codes[$status_code]}");
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
    
    /**
     * Performs a HTTP header 301 redirect
     *
     * @param string $path Page location path
     *
     * @return void
     *
     * @access public
     */
    public function setPageContentType($content_type, $charset = 'utf-8')
    {
        header("Content-type: {$content_type}; charset: {$charset}");
    }
    
    /**
     * Performs a HTTP header 301 redirect
     *
     * @param string $path Page location path
     *
     * @return void
     *
     * @access public
     */
    public function setPageRedirect($path)
    {
        if (empty($path) === false && is_string($path)) {
            $this->setHttpStatus(301);
            header("Location: {$path}");
        }
    }
    
    /**
     * Sets URI segments
     *
     * @param array $uri_segments URI segments
     *
     * @return void
     *
     * @access public
     */
    public function setUriSegments(array $uri_segments)
    {
        $this->_uri_segments = $_uri_segments;
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
        return ($this->getHttpMethod() == 'AJAX');
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
            strpos($this->getHttpUserAgent(), 'bot') !== false OR
            strpos($this->getHttpUserAgent(), 'googlebot') !== false OR
            strpos($this->getHttpUserAgent(), 'msnbot') !== false OR
            strpos($this->getHttpUserAgent(), 'slurp') !== false OR
            strpos($this->getHttpUserAgent(), 'spider') !== false OR
            strpos($this->getHttpUserAgent(), 'yahoo!') !== false
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
        return ($this->getHttpMethod() == 'DELETE');
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
        return ($this->getHttpMethod() == 'GET');
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
        return ($this->getHttpMethod() == 'HEAD');
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
        return ($this->getHttpMethod() == 'POST');
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
        return ($this->getHttpMethod() == 'PUT');
    }
}

/**
 * END ToucaNine/Request/Request.php
 */