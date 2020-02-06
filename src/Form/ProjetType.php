<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('langProj',  EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'label',
                'expanded' => true,
                'multiple' => false,
                'required' => true
            ])
            ->add('langTrad',  EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'label',
                'expanded' => true,
                'multiple' => true,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
