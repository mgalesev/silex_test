<?php

require_once __DIR__.'/bootstrap.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use DerAlex\Silex\YamlConfigServiceProvider;
use Gallery\Service\GalleryServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Gallery\Form\ImageType;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\SessionServiceProvider;



$app = new Application();

// register service providers
$app->register(new YamlConfigServiceProvider(__DIR__ . '/config/config.yml'));
$app->register(new DoctrineServiceProvider(), array('db.options' => $app['config']['database']));
$app->register(new TwigServiceProvider(), $app['config']['twig']);
$app->register(new GalleryServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider(), array('translator.messages' => array()));
$app->register(new SessionServiceProvider());

// extend form types
$app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
    $types[] = new ImageType();

    return $types;
}));

// set routes
foreach ($app['config']['routes'] as $route) {
    $registeredRoute = call_user_func(array($app, $route['method']), $route['path'], $route['action']);
    if (isset($route['required'])) {
        foreach ($route['required'] as $param=>$rule) {
            $registeredRoute->assert($param, $rule);
        }
    }
}

// set debuger
$app['debug'] = $app['config']['debug'];

return $app;
