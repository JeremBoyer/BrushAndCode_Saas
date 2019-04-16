<?php

namespace App\Controller;

use App\Entity\Quotation;
use App\Form\QuotationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\CreatePdfService;

class CustomerController extends AbstractController
{

    /**
     * @Route("/", name="customer")
     */
    public function customer(
        Request $resquest,
        CreatePdfService $pdf
    )
    {
        $quotation = new Quotation() ;

        $quotationForm = $this->createForm(QuotationType::class, $quotation);
        $quotation->setCreatedAt(new \DateTime());
        $quotation->setStatus(Quotation::TOANSWER);

        $quotationForm->handleRequest($resquest);

        $html = $this->renderView('default/mypdf.html.twig', [

            'date' => $quotation->getCreatedAt()->format("d/m/Y"),
            'email' => $quotation->getEmail(),
            'comment' => $quotation->getComment()

        ]);
        $pdf->createPdf($html);


        if ($quotationForm->isSubmitted() && $quotationForm->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quotation);

            $entityManager->flush();

        }

        return $this->render('customer/customer.html.twig' , [
            'quotationForm' => $quotationForm->createView()
        ]);

    }

}