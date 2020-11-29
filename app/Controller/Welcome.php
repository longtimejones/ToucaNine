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
 * @author     Tim Jong Olesen <longtimejones@protonmail.com>
 * @copyright  Copyright (c) 2020, Tim Jong Olesen
 * @link       https://github.com/longtimejones/toucanine/
 * @license    https://github.com/longtimejones/toucanine/blob/master/LICENSE
 */
class Welcome extends Controller
{
    public function helloWorld()
    {
        $this->view->assign('page_title', 'Hello, world!');
        $this->view->assign('page_content', 'This is a rather simple page huh!');
        $this->view->assign('app_profiling', $this->helper('Profiling')->application());
        $this->view->render('template.html');
    }

    public function helloGuest($guest)
    {
        $this->view->assign('page_content', 'This page demonstrates the usage of HTML Purifier, and HMVC.');

        $this->controller('Guest')->invoke('hello', array($guest));
    }

    public function helloUser($user)
    {
        $user = $this->helper('Html')->purifier()->purify($user);
        $user = $this->model('User')->byUsername($user)->first();

        $this->view->assign('page_title', "Hello user, {$user->username}!");
        $this->view->assign('page_content', 'This page demonstrates the usage of Illuminate Database, and HTML Purifier.');
        $this->view->assign('app_profiling', $this->helper('Profiling')->application());
        $this->view->render('template.html');
    }
}

/**
 * END App/Controller/Welcome.php
 */