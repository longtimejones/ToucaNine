<?php
require realpath(dirname(__FILE__) . '/../src/lib/ToucaNine/Bootstrapper.php');

$app->route('GET /foo/([^/]+)/([^/]+)', array(
    'Demo',
    'fooBar',
    '$1',
));

/**
 * Set route, default
 */
$app->route('GET /', function () use ($app) {
    echo '<h1>ToucaNine</h1>';
    echo '<ul>';
    echo '<li><a href="/hello-guest/foo">Hello Guest demo page</a></li>';
    echo '<li><a href="/hello-stranger">Hello Stranger demo page</a></li>';
    echo '<li><a href="/hello-world">Hello World demo page</a></li>';
    echo '</ul>';
    echo '<p>' . profileApplication() . '</p>';
});
/**
 */

/**
 * Set route, hello guest
 */
$app->route('GET /hello-guest/([^/]+)', array(
    'Welcome',
    'helloGuest',
    '$1',
));
/**
 */

/**
 * Set route, hello stranger
 */
$app->route('GET /hello-stranger', array(
    'Welcome',
    'helloStranger',
    '$1',
));
/**
 */

/**
 * Set route, hello world
 */
$app->route('GET /hello-world', array(
    'Welcome',
    'helloWorld',
));
/**
 */

/**
 * Set route, error
 */
$app->route('GET /errors/([^/]+)', array(
    'Errors',
    'status2',
    '$1',
));
/**
 */

/**
 * Set route, catch all
 */
$app->route('GET .+', array(
    'Errors',
    'status',
    301,
));
/**
 */

$app->dispatch();