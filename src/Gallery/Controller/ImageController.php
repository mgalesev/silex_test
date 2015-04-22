<?php

namespace Gallery\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ImageController
{
    public function indexAction(Request $request, Application $app)
    {
//        $artist = $request->attributes->get('artist');
//        if (!$artist) {
//            $app->abort(404, 'The requested artist was not found.');
//        }

        $data = array(
          'data' => 'ddddddd',
        );

        return $app['twig']->render('Image/index.html.twig', $data);
    }
}