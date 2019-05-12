<?php
namespace App\Service;

use App\Entity\Quotation;

class SendEmailService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * SendEmailService constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {

        $this->mailer = $mailer;

    }

    /**
     * Set object Swift Message for send to customer
     *
     * @param $titleMessage
     * @param $body
     * @param Quotation $quotation
     * @return \Swift_Message
     */
    public function setSwiftMail($titleMessage, $body, Quotation $quotation)
    {

        $message = (new \Swift_Message($titleMessage))
//            ->setFrom('webmaster@madboyeslab.com')
            ->setFrom('jereboyer08@gmail.com')
            ->setTo($quotation->getEmail())
            ->setBody($body, 'text/html');

        return $message;
    }

    /**
     * Set Swift Message object for send form to BrushAndCode
     *
     * @param $body
     * @param Quotation $quotation
     * @return \Swift_Message
     */
    public function setSwiftMailToBrushAndCode($body, Quotation $quotation)
    {

        $message = (new \Swift_Message($quotation->getEmail()))
//            ->setFrom('webmaster@madboyeslab.com')
            ->setFrom('jereboyer08@gmail.com')
            ->setTo('jereboyer@hotmail.fr')
            ->setBody($body, 'text/html');

        return $message;
    }

    /**
     * Attach a pdf to Swift object
     *
     * @param $fileName
     * @param \Swift_Message $message
     * @param null $pdf
     * @return \Swift_Message
     */
    public function attachmentSwiftMail($fileName, \Swift_Message $message, $pdf = null)
    {

        $message->attach(new \Swift_Attachment($pdf, $fileName, "application/pdf"));

        return $message;

    }

    /**
     * Send a Swift mail
     *
     * @param \Swift_Message $message
     */
    public function sendSwiftMail(\Swift_Message $message)
    {

        $this->mailer->send($message);

    }

}