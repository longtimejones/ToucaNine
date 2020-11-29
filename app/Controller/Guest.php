<?php
namespace App\Controller;
use ToucaNine\Controller\Controller;

/**
 * Guest Controller
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
class Guest extends Controller
{
    public function hello($guest)
    {
        $guest = $this->helper('Html')->purifier()->purify($guest);

        $this->view->assign('page_title', "Hello guest, {$guest}!");
        $this->view->assign('app_profiling', $this->helper('Profiling')->application());
        $this->view->render('template.html');
    }
}

/**
 * END App/Controller/Guest.php
 */