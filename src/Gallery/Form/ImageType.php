<?php

namespace Gallery\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name')
          ->add('sss')
          ->add('save', 'submit');
    }

    public function getName()
    {
        return 'image_add';
    }

//    public function getExtendedType()
//    {
//        return 'form';
//    }
}
