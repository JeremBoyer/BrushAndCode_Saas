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


        if ($quotation->getPackageType() === [0 => Quotation::BASEPACK]) {

            $htmlPdf = $this->templating->render('default/mypdf.html.twig', [

                'date' => $quotation->getCreatedAt()->format("d/m/Y"),
                'email' => $quotation->getEmail(),

            ]);

            $htmlMail = $this->templating->render('email/base_pack.html.twig', [

                'date' => $quotation->getCreatedAt()->format("d/m/Y")

            ]);

            $message = $mail->setSwiftMail('Brush&Code, Base Pack', $htmlMail, $quotation);

            $message_attachment = $mail->attachmentSwiftMail(
                'base_pack.pdf',
                $message,
                $pdf->createPdf($htmlPdf)
            );

            $mail->sendSwiftMail($message_attachment);
//            $mail->sendSwiftMail($message);

        } else {

            $htmlMail = $this->templating->render('email/premium_pack.html.twig', [



            ]);

            $message = $mail->setSwiftMail('Brush&Code, Premium Pack', $htmlMail, $quotation);

            $mail->sendSwiftMail($message);
        }

    }

    public function resultFormToBrushAndCode (Quotation $quotation, SendEmailService $mail)
    {

        $htmlMail = $this->templating->render('email/to_brush_and_code.html.twig', [

            'quotation' => $quotation,

        ]);

        $message = $mail->setSwiftMailToBrushAndCode($htmlMail, $quotation);

        $mail->sendSwiftMail($message);

    }

}