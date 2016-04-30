<?php

namespace NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            // ->add('body')
            ->add('category')
        ;
        
        $builder->add('body', 'textarea', array(
            'attr'=>array(
            'class' => 'mytextarea',
            'name' => 'article[body]',
            'id' => 'article[body]',
            'novalidate'=>'novalidate'
            )
        ));
        
        $builder->add('imageFile', 'vich_image', array(
        'required'      => false,
        'allow_delete'  => true, // not mandatory, default is true
        'download_link' => true, // not mandatory, default is true
        ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NewsBundle\Entity\Article'
        ));
    }
}
