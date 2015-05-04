<?php

namespace Gallery\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ImageController
{
    public function indexAction(Application $app)
    {
        $images = $app['gallery_service']->getImages();

        return $app['twig']->render('Image/index.html.twig', array(
            'title' => 'Images',
            'images' => $images,
        ));
    }

    /**
     * Add image.
     *
     * @param Request     $request
     * @param Application $app
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, Application $app)
    {
        $form = $app['form.factory']
          ->createBuilder('image_add')
          ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($app['gallery_service']->createImage($form->getData())) {
                $app['session']->getFlashBag()->add('sucess', 'Sucessfully added new image.');

                return $app->redirect('/image');
            }
            else {
                $app['session']->getFlashBag()->add('error', 'Unable to create new image.');
            }
        }

        return $app['twig']->render('Image/add.html.twig', array(
            'title' => 'Add image',
            'form' => $form->createView()
        ));
    }

    /**
     * Edit image.
     *
     * @param Request     $request
     * @param Application $app
     * @param int         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request, Application $app, $id)
    {
        $image = $app['gallery_service']->getImage($id);
        if (empty($image)) {
            throw new ResourceNotFoundException('Image not found');
        }

        $form = $app['form.factory']
          ->createBuilder('image_add', $image)
          ->getForm($image);

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($app['gallery_service']->editImage($id, $form->getData())) {
                $app['session']->getFlashBag()->add('sucess', 'Image successfully edited.');

                return $app->redirect('/image');
            }
            else {
                $app['session']->getFlashBag()->add('error', 'Unable to create new image.');
            }
        }

        return $app['twig']->render('Image/add.html.twig', array(
          'title' => 'Edit image',
          'form' => $form->createView()
        ));
    }

    /**
     * Delete image.
     *
     * @param Request     $request
     * @param Application $app
     * @param int         $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Application $app, $id)
    {
        $image = $app['gallery_service']->getImage($id);
        if (empty($image)) {
            throw new ResourceNotFoundException('Image not found');
        }

        $form = $app['form.factory']->createBuilder('form')
            ->add('cancel', 'submit', array(
              'label' => 'Cancel',
              'attr' => array(
                'class' => 'btn btn-default',
              ),
            ))
            ->add('delete', 'submit', array(
              'label' => 'Delete',
              'attr' => array(
                  'class' => 'btn btn-sm btn-danger',
              ),
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->get('cancel')->isClicked())
        {
            return $app->redirect('/image');
        }
        elseif ($form->get('delete')->isClicked())
        {
            if ($app['gallery_service']->deleteImage($id)) {
                $app['session']->getFlashBag()->add('sucess', 'Image successfully deleted.');

                return $app->redirect('/image');
            }
            else {
                $app['session']->getFlashBag()->add('error', 'Unable to delete image.');
            }
        }

        return $app['twig']->render('Image/delete.html.twig', array(
          'title' => 'Confirm delete',
          'form' => $form->createView()
        ));
    }
}