<?php
require __DIR__ . '/../src/Bootstrapper.php';

/**
 * Set route, default
 */
$app->route('GET /', function () use ($app) {
    $app->view->assign('page_title', 'Welcome!');
    $app->view->assign('page_content', 'You have successfully installed the ToucaNine micro framework.');
    $app->view->assign('app_profiling', $app->helper('Profiling')->application());
    $app->view->render('template.html');
});

/**
 * Set route, hello world
 */
$app->route('GET /hello-world', array(
    'Welcome',
    'helloWorld',
));

/**
 * Set route, hello guest
 */
$app->route('GET /hello-guest/([^/]+)', array(
    'Welcome',
    'helloGuest',
    '$1',
));

/**
 * Set route, hello user
 */
$app->route('GET /hello-user/([^/]+)', array(
    'Welcome',
    'helloUser',
    '$1',
));

/**
 * Set route, error
 */
$app->route('GET /error/([^/]+)', array(
    'Error',
    'status2',
    '$1',
));

/**
 * Set route, catch all
 */
$app->route('GET .+', array(
    'Error',
    'status',
    404,
));

$app->dispatch();