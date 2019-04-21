<?php
namespace App\Service;


use Symfony\Component\Templating\EngineInterface;

class SendEmailService
{

    private $mailer;

    private $engine;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $engine)
    {

        $this->mailer = $mailer;
        $this->engine = $engine;

    }

    public function sendSwiftMail($titleMessage, $adress, $twig)
    {

        $message = (new \Swift_Message($titleMessage))
            ->setFrom('webmaster@madboyeslab.com')
            ->setTo($_POST[$adress])
            ->setBody(
                $this->engine->render($twig, [

                ])
            );

        $this->mailer->send($message);
    }

}