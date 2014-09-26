<?php
namespace App\Controller;
use ToucaNine\Controller\Controller;

/**
 * Error controller
 *
 * @package    ToucaNine
 * @subpackage Application
 * @category   Controller
 *
 * @author     Tim Jong Olesen <tim@olesen.be>
 * @copyright  Copyright (c) 2014, Tim Jong Olesen
 * @link       http://tim.olesen.be/toucanine/
 * @license    http://tim.olesen.be/toucanine/license/
 */
class Error extends Controller
{
    /**
     * Outputs an error page
     *
     * @param string $page_name Entry name
     *
     * @return void
     *
     * @access public
     */
    public function status($code = 0)
    {
        $status_code = intval($code);

        if ($status_code > 200)
            $this->http->setHttpStatus($status_code);

        $page_title   = "Error {$status_code}";
        $page_content = 'This is most definitely not the page you\'re looking for!';

        if ($status_code >= 500)
            $page_content = 'Oh no, even the best falls short sometimes! This is most definitely an error :-)';

        $this->view->assign('page_title', $page_title);
        $this->view->assign('page_content', $page_content);
        $this->view->assign('app_profiling', $this->helper('Profiling')->application());
        $this->view->render('template.html');
    }
}

/**
 * END App/Controller/Error.php
 */