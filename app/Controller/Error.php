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
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
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