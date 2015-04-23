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

    public function addAction(Request $request, Application $app)
    {
//        $form = $app['form.factory']->createBuilder('form', array())
//          ->add('name')
//          ->add('email')
//          ->add('gender', 'choice', array(
//            'choices' => array(1 => 'male', 2 => 'female'),
//            'expanded' => true,
//          ))
//          ->getForm();

        $form = $app['form.factory']
          ->createBuilder('image_add')
          ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            // do something with the data

            return $app->redirect('/image');
        }

        return $app['twig']->render('Image/add.html.twig', array(
          'form' => $form->createView()
        ));

    }
}