<?php

namespace Gallery\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class BasicPageController
{
    public function homeAction(Request $request, Application $app)
    {
        $data = array(
          'data' => 'Welcome',
        );

        return $app['twig']->render('Basic/home.html.twig', $data);
    }
}