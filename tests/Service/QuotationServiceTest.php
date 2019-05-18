<?php
namespace App\Tests\Service;

use App\Entity\Quotation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuotationServiceTest extends WebTestCase
{

    protected $templating;

    public function test__construct($templating)
    {

        $this->templating = $templating;

    }

    public function testChoicePack()
    {
        $quotation = new Quotation();

        $quotation->setPackageType([0 => Quotation::BASEPACK]);




    }

    public function testResultFormToBrushAndCode()
    {


    }

}