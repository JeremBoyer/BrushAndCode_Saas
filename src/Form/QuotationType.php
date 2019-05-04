<?php

namespace App\Form;

use App\Entity\Quotation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuotationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class)
            ->add('packageType', ChoiceType::class, [
                'choices' => [
                    "BASEPACK" => Quotation::BASEPACK,
                    "EMARKETING" => Quotation::EMARKETING,
                    "DESIGN" => Quotation::DESIGN,
                    "DEVELOPMENT" => Quotation::DEVELOPMENT,
                ],
                'multiple' => true,
                'expanded' => true

            ])
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quotation::class,
        ]);
    }
}
