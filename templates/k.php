<?php

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

require_once "vendor/autoload.php";

session_start();

$session = new Session(new PhpBridgeSessionStorage());
$session->start();


$loader1 = new Twig_Loader_Array(array(
    'koseu/array.twig' => 'Hello {{ name }} DUDE',
));

$loader2 = new Twig_Loader_Filesystem(__DIR__);

$loader = new Twig_Loader_Chain(array($loader1, $loader2));

$app = new Silex\Application();
$app['session'] = $session;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    // 'twig.path' => __DIR__,
    'twig.loader' => $loader
));

$app->get('/hello/{name}', function ($name) use ($app) {
    // return $app['twig']->render('hello.twig', array(
    if ( isset($_SESSION['x'])) {
        $_SESSION['x']++;
    } else {
        $_SESSION['x'] = 42;
    }
    print_r($_SESSION);
    if ( $app['session']->has('y') ) {
        $app['session']->set('y', $app['session']->get('y')+1);
    } else {
        $app['session']->set('y', 20);
    }
    print_r($app['session']->all());
    return $app['twig']->render('koseu/array.twig', array(
        'name' => $name,
    ));
});

$app->run();

echo("YO\n");
