<?php

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

require_once "../vendor/autoload.php";

require_once "views.php";
require_once "loader.php";

session_start();


$loader1 = new Twig_Loader_Array(array(
    'koseu/array.twig' => 'Hello {{ name }} Twig_Loader_Array',
));

$loader2 = new Twig_Loader_Filesystem(__DIR__);

$loader3 = new Twig_Loader_Class();

$loader = new Twig_Loader_Chain(array($loader1, $loader2, $loader3));

$app = new Silex\Application();
$session = new Session(new PhpBridgeSessionStorage());
$session->start();
$app['session'] = $session;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    // 'twig.path' => __DIR__,
    'twig.loader' => $loader
));

$app->get('/file/{name}', function ($name) use ($app) {
    echo("<pre>\n");
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

$app->get('/array/{name}', function ($name) use ($app) {
    echo("<pre>\n");
    return $app['twig']->render('koseu/array.twig', array(
        'name' => $name,
    ));
});

$app->get('/class/{name}', function ($name) use ($app) {
    echo("<pre>\n");
    return $app['twig']->render('\myview', array(
        'name' => $name,
    ));
});

$app->run();

