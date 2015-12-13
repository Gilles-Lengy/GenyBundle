<?php

namespace GenyBundle\Form\Type;

use GenyBundle\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuilderType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('title', Type\TextType::class, [
               'attr' => [
                   'placeholder' => 'geny.builder.title.placeholder',
               ],
               'empty_data' => $this->get('translator')->trans('geny.builder.title.default', [], 'geny'),
               'label' => 'geny.builder.title.label',
               'required' => true,
           ])
           ->add('description', Type\TextareaType::class, [
               'attr' => [
                   'placeholder' => 'geny.builder.description.placeholder',
               ],
               'empty_data' => null,
               'label' => 'geny.builder.description.label',
               'required' => false,
           ])
           ->add('submit', Type\TextType::class, [
               'attr' => [
                   'placeholder' => 'geny.builder.submit.placeholder',
               ],
               'empty_data' => $this->get('translator')->trans('geny.builder.submit.default', [], 'geny'),
               'label' => 'geny.builder.submit.label',
               'required' => true,
           ])
       ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'GenyBundle\Entity\Form',
            'translation_domain' => 'geny',
        ]);
    }
}
