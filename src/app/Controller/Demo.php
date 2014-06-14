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
class Demo extends Controller
{
    public function helloFoo()
    {
        $this->view->assign('page_title', 'Hello Foo');
        $this->view->assign('page_content', profileApplication());
        $this->view->render('page.html');
    }
    public function fooBar($param, $param2 = 0)
    {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
        echo '<pre>';
        var_dump($param2);
        echo '</pre>';
    }
}

/**
 * END App/Controller/Demo.php
 */