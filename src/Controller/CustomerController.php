<?php

namespace App\Controller;

use App\Entity\Quotation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                            ->getForm();

        return $this->render('customer/customer.html.twig' , [
            'quotationForm' => $quotationForm->createView()
        ]);

    }

}