<?php

/**
 * This explores the idea of loading Twig views using the autoloader and class
 * loader.  We chain the array loader, file loader and class loader together.
 * The class loader looks for templates with names that start with "\" to indicate
 * that these should be instantiated as classes.
 */

require_once "../vendor/autoload.php";

require_once "views.php";  // Our view in a class
require_once "loader.php"; // The Twig_loader_Class code

$loader1 = new Twig_Loader_Array(array(
    'koseu/array.twig' => 'Hello {{ name }} Twig_Loader_Array',
));

$loader2 = new Twig_Loader_Filesystem(__DIR__);

$loader3 = new Twig_Loader_Class();

$loader = new Twig_Loader_Chain(array($loader1, $loader2, $loader3));

$app = new Silex\Application();

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

