<?php

namespace App\Controller;

use App\Entity\Quotation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{

    /**
     * @Route("/", name="customer")
     */
    public function customer(Request $resquest)
    {
        $quotation = new Quotation() ;

        $quotationForm = $this->createFormBuilder($quotation)
                            ->add('comment', TextareaType::class)
                            ->add('packageType', ChoiceType::class, [
                                'choices' => [
                                    "Base" => Quotation::BASE,
                                    "Marketing" => Quotation::MARKETING,
                                    "Design" => Quotation::DESIGN,
                                    "Development" => Quotation::DEVELOPMENT,
                                ],
                                'multiple' => true,
                                'expanded' => true

                            ])
                            ->add('email')
                            ->getForm();
//        dump($quotationForm, $quotation);

        return $this->render('customer/customer.html.twig' , [
            'quotationForm' => $quotationForm->createView()
        ]);

    }

}