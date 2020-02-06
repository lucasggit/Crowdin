<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password',  PasswordType::class)
            ->add('confirm_password',  PasswordType::class)
            ->add('username')
            ->add('language',  EntityType::class, [
                'class' => Langue::class,
                'choice_label' => 'label',
                'expanded' => true,
                'multiple' => true,
                'required' => true
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
