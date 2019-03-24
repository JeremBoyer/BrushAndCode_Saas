<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('username')
//            ->add('usernameCanonical')
//            ->add('email')
//            ->add('emailCanonical')
//            ->add('enabled')
//            ->add('salt')
//            ->add('password')
//            ->add('lastLogin')
//            ->add('confirmationToken')
//            ->add('passwordRequestedAt')
//            ->add('roles')
            ->add('firstName')
//            ->add('business')
//            ->add('independent')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
