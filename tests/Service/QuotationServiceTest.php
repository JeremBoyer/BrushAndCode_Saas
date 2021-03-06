<?php
namespace App\Tests\Service;

use App\Entity\Quotation;
use App\Service\CreatePdfService;
use App\Service\QuotationService;
use App\Service\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Templating\EngineInterface;

class QuotationServiceTest extends WebTestCase
{
    /**
     * @group testChoice
     */
    public function testChoiceBasePack()
    {
        $quotation = new Quotation();
        $date = new \DateTime();

        $quotation->setPackageType([0 => Quotation::BASEPACK]);
        $quotation->setCreatedAt($date);
        $quotation->setEmail('jereboyer@hotmail.fr');

        $engineInterfaceMock = $this->createMock(EngineInterface::class);
        $createPdfMock = $this->createMock(CreatePdfService::class);
        $sendEmailMock = $this->createMock(SendEmailService::class);
        $swiftMessageMock = $this->createMock(\Swift_Message::class);


        $engineInterfaceMock->expects($this->exactly(2))
            ->method('render')
            ->withConsecutive(
                [
                    $this->equalTo('default/mypdf.html.twig'),
                    $this->equalTo([
                        'date'  => $date->format("d/m/Y"),
                        'email' => 'jereboyer@hotmail.fr',
                    ]),
                ],
                [
                    $this->equalTo('email/base_pack.html.twig'),
                    $this->equalTo([
                        'date'  => $date->format("d/m/Y"),
                    ]),
                ]
            );
        $sendEmailMock->expects($this->exactly(1))
            ->method('setSwiftMail')
            ->willReturn($swiftMessageMock)
        ;

        $createPdfMock->expects($this->once())
            ->method("createPdf")
            ->willReturn("pdf")
        ;

        $sendEmailMock->expects($this->once())
            ->method('attachmentSwiftMail')
            ->with(
                $this->equalTo('base_pack.pdf'),
                $this->equalTo($swiftMessageMock),
                $this->equalTo("pdf")
            )
            ->willReturn($swiftMessageMock)
        ;

        $sendEmailMock->expects($this->once())
            ->method("sendSwiftMail")
            ->with(
                $this->equalTo($swiftMessageMock)
            );

        $quotationService = new QuotationService($engineInterfaceMock);

        $quotationService->choicePack($quotation, $createPdfMock, $sendEmailMock);
    }


    /**
     * @group testChoice
     */
    public function testChoicePremiumPack()
    {
        $quotation = new Quotation();
        $date = new \DateTime();


        $quotation->setPackageType([0 => Quotation::DESIGN]);
        $quotation->setCreatedAt($date);
        $quotation->setEmail('jereboyer@hotmail.fr');

        $engineInterfaceMock = $this->createMock(EngineInterface::class);
        $sendEmailMock = $this->createMock(SendEmailService::class);
        $swiftMessageMock = $this->createMock(\Swift_Message::class);


        $engineInterfaceMock->expects($this->once())
            ->method('render')
            ->with(
                    $this->equalTo('email/premium_pack.html.twig'),
                    $this->equalTo([
                        "quotation" => $quotation
                    ])
            )
            ->willReturn("htmlMail")
        ;

        $sendEmailMock->expects($this->exactly(1))
            ->method('setSwiftMail')
            ->with(
                $this->equalTo('Brush&Code, Premium Pack'),
                $this->equalTo("htmlMail"),
                $this->equalTo($quotation)
            )
            ->willReturn($swiftMessageMock)
        ;

        $sendEmailMock->expects($this->once())
            ->method('sendSwiftMail')
            ->with($swiftMessageMock)
        ;



        $quotationService = new QuotationService($engineInterfaceMock);

        $quotationService->choicePack($quotation, null, $sendEmailMock);

    }

    /**
     * @group testChoice
     */
    public function testResultFormToBrushAndCode()
    {

        $quotation = new Quotation();
        $date = new \DateTime();


        $quotation->setPackageType([0 => Quotation::DESIGN]);
        $quotation->setCreatedAt($date);
        $quotation->setEmail('jereboyer@hotmail.fr');

        $engineInterfaceMock = $this->createMock(EngineInterface::class);
        $sendEmailMock = $this->createMock(SendEmailService::class);
        $swiftMessageMock = $this->createMock(\Swift_Message::class);


        $engineInterfaceMock->expects($this->once())
            ->method('render')
            ->with(
                $this->equalTo('email/to_brush_and_code.html.twig'),
                $this->equalTo([
                    "quotation" => $quotation
                ])
            )
            ->willReturn("htmlMail")
        ;

        $sendEmailMock->expects($this->exactly(1))
            ->method('setSwiftMailToBrushAndCode')
            ->with(
                $this->equalTo("htmlMail"),
                $this->equalTo($quotation)
            )
            ->willReturn($swiftMessageMock)
        ;

        $sendEmailMock->expects($this->once())
            ->method('sendSwiftMail')
            ->with($swiftMessageMock)
        ;



        $quotationService = new QuotationService($engineInterfaceMock);

        $quotationService->resultFormToBrushAndCode($quotation, $sendEmailMock);

    }

}