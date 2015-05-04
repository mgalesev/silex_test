<?php

namespace Gallery\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class BasicPageController
{
    public function homeAction(Application $app)
    {

        $data = array(
          'data' => 'Welcome',
        );

        return $app['twig']->render('Basic/home.html.twig', $data);
    }
}