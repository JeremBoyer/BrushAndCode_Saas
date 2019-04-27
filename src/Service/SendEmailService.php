<?php
namespace App\Service;

use App\Entity\Quotation;

class SendEmailService
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {

        $this->mailer = $mailer;

    }

    public function setSwiftMail($titleMessage, $body, Quotation $quotation)
    {

        $message = (new \Swift_Message($titleMessage))
//            ->setFrom('webmaster@madboyeslab.com')
            ->setFrom('jereboyer08@gmail.com')
            ->setTo($quotation->getEmail())
            ->setBody($body, 'text/html');

        return $message;
    }

    public function attachmentSwiftMail($fileName, \Swift_Message $message, $pdf = null)
    {

        $attachment = (new \Swift_Attachment($pdf, $fileName));

        $message->attach($attachment);

        return $message;

    }

    public function sendSwiftMail(\Swift_Message $message)
    {

        $this->mailer->send($message);

    }

}