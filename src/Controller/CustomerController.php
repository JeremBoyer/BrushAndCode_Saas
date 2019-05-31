<?php

namespace App\Controller;

use App\Entity\Quotation;
use App\Form\QuotationType;
use App\Service\QuotationService;
use App\Service\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\CreatePdfService;

class CustomerController extends AbstractController
{

    /**
     * @Route("/", name="customer")
     */
    public function customer()
    {


        return $this->render('customer/customer.html.twig');

    }

    /**
     * @Route("/quotation", name="quotation")
     */
    public function quotation(
        Request $resquest,
        CreatePdfService $pdf,
        SendEmailService $mail,
        QuotationService $quotationService
    )
    {
        $quotation = new Quotation() ;

        $quotationForm = $this->createForm(QuotationType::class, $quotation);

        $quotation->setCreatedAt(new \DateTime());
        $quotation->setStatus(Quotation::TOANSWER);

        $quotationForm->handleRequest($resquest);

        if ($quotationForm->isSubmitted() && $quotationForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quotation);

            $entityManager->flush();

            $quotationService->choicePack($quotation, $pdf, $mail);

            $quotationService->resultFormToBrushAndCode($quotation, $mail);

            $this->redirectToRoute("confirmation");

        }

        return $this->render('customer/quotation.html.twig' , [
            'quotationForm' => $quotationForm->createView()
        ]);
    }

    /**
     * @Route("/confirmation", name="confirmation")
     */
    public function confirmation()
    {

        return $this->render("customer/confirmation.html.twig");

    }


}