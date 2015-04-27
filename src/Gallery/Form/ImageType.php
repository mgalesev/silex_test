<?php

namespace Gallery\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    /**
     * Build form fields.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name', 'text', array(
              'label' => 'Name',
              'required' => true,
              'attr' => array(
                'class' => 'form-control',
              )
          ))
          ->add('type_id', 'choice', array(
              'label' => 'Type',
              'choices' => array('Small', 'Large'),
              'required' => true,
              'attr' => array(
                'class' => 'form-control',
              )
          ))
          ->add('save', 'submit', array(
              'attr' => array(
                  'class' => 'btn btn-default',
              )
          ));
    }

    public function getName()
    {
        return 'image_add';
    }
}
