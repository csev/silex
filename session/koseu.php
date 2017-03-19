<?php

/*
 * This tests storing Siles/Symfonty sessions in the default PHP
 * store and makes $_SESSION work.
 *
 * http://symfony.com/doc/current/components/http_foundation/session_php_bridge.html
 */

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

require_once "../vendor/autoload.php";

session_start();
$session = new Session(new PhpBridgeSessionStorage());
$session->start();
$app = new Silex\Application();
$app['session'] = $session;

$app->get('/hello/{name}', function ($name) use ($app) {
    echo("<pre>\n");

    echo("Symfony Session:\n");
    if ( $app['session']->has('y') ) {
        $app['session']->set('y', $app['session']->get('y')+1);
    } else {
        $app['session']->set('y', 20);
    }
    print_r($app['session']->all());

    echo("\nPHP Session:\n");
    if ( isset($_SESSION['x'])) {
        $_SESSION['x']++;
    } else {
        $_SESSION['x'] = 42;
    }
    print_r($_SESSION);

    echo("</pre>\n");
    return "<p>Hello $name - refresh the page to increment x and y</p>\n";
});

$app->run();
