<?php

require_once __DIR__.'/bootstrap.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use DerAlex\Silex\YamlConfigServiceProvider;


$app = new Application();

$app->register(new YamlConfigServiceProvider(__DIR__ . '/config/config.yml'));

$app->register(new DoctrineServiceProvider(), $app['config']['database']);
$app->register(new TwigServiceProvider(), $app['config']['twig']);

// set routes
foreach ($app['config']['routes'] as $route) {
    call_user_func(array($app, $route['method']), $route['path'], $route['action']);
}


$app['debug'] = $app['config']['debug'];

return $app;