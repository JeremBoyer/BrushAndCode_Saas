<?php

namespace App\Controller;

use App\Entity\Quotation;
use App\Form\QuotationType;
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

        $quotationForm = $this->createForm(QuotationType::class, $quotation);
        $quotation->setCreatedAt(new \DateTime());

        $quotation->setStatus(Quotation::TOANSWER);

        $quotationForm->handleRequest($resquest);

        dump($quotation);

        dump($quotation->getPackageType());

        if ($quotationForm->isSubmitted() && $quotationForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quotation);

            $entityManager->flush();


        }
//        dump($quotationForm, $quotation);

        return $this->render('customer/customer.html.twig' , [
            'quotationForm' => $quotationForm->createView()
        ]);

    }

}