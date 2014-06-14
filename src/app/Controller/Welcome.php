<?php
namespace App\Controller;
use ToucaNine\Controller\Controller;

/**
 * Welcome Controller
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
class Welcome extends Controller
{
    public function helloGuest($stranger)
    {
        $guest = $this->model('Page')->getTestData($stranger);

        $this->view->assign('page_title', 'Hello Guest');
        $this->view->assign('page_content', profileApplication());
        $this->view->render('page.html');
    }

    public function helloStranger()
    {
        $this->controller('Demo')->invoke('helloFoo');
    }

    public function helloWorld()
    {
        $this->view->assign('page_title', 'Hello World');
        $this->view->assign('page_content', profileApplication());
        $this->view->render('page.html');
    }
}

/**
 * END App/Controller/Welcome.php
 */