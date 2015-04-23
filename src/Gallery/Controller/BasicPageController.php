<?php

namespace Gallery\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class BasicPageController
{
    public function homeAction(Request $request, Application $app)
    {
//        $artist = $request->attributes->get('artist');
//        if (!$artist) {
//            $app->abort(404, 'The requested artist was not found.');
//        }

        $data = array(
          'data' => 'Welcome',
        );

        return $app['twig']->render('Basic/home.html.twig', $data);
    }
}