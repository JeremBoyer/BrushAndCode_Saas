<?php
namespace App\Service;


use App\Entity\Quotation;
use Symfony\Component\Templating\EngineInterface;

class QuotationService
{
    private $templating;



    public function __construct(EngineInterface $templating)
    {

        $this->templating = $templating;

    }

    public function choicePack(Quotation $quotation, CreatePdfService $pdf = null, SendEmailService $mail)
    {


        if ($quotation->getPackageType() === [0 => Quotation::BASE]) {

            $htmlPdf = $this->templating->render('default/mypdf.html.twig', [

                'date' => $quotation->getCreatedAt()->format("d/m/Y"),
                'email' => $quotation->getEmail(),
                'comment' => $quotation->getComment()

            ]);
//            dump($htmlPdf);
//            die();

            $pdf->createPdf($htmlPdf);

            $htmlMail = $this->templating->render('email/base_pack.html.twig', [

                'date' => $quotation->getCreatedAt()->format("d/m/Y")

            ]);

            $message = $mail->setSwiftMail('Brush&Code, Pack de base', $htmlMail, $quotation);

            $message_attachment = $mail->attachmentSwiftMail('Mon_Devis', $message, $pdf);

            $mail->sendSwiftMail($message_attachment);
//            $mail->sendSwiftMail($message);

        } else {

            $htmlMail = $this->templating->render('email/premium_pack.html.twig', [



            ]);

            $message = $mail->setSwiftMail('Brush&Code, Pack de base', $htmlMail, $quotation);

            $mail->sendSwiftMail($message);
        }

    }

}