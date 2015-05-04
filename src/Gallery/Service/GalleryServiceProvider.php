<?php

namespace Gallery\Service;

use Silex\Application;
use Silex\ServiceProviderInterface;

class GalleryServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['gallery_service'] = new GalleryService($app['db']);
    }

    public function boot(Application $app)
    {
    }
}
