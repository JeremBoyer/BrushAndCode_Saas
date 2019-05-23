<?php
namespace App\Tests\Controller;

use App\Entity\Quotation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class CustomerControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @group testFunctional
     */
    public function testChoicePageIsUp()
    {
        $this->client->request('GET', '/');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * @group testFunctional
     */
    public function testQuotationForm()
    {

        $client = static::createClient();
        $crawler = $client->request('POST', '/quotation');

        $form = $crawler->selectButton('Enregistrer')->form();



// set some values
        $form['quotation[email]'] = 'jereboyer@hotmail.fr';
        $form['quotation[comment]'] = 'Je veux faire un test';
        $form['quotation[packageType]'] = [0 => Quotation::BASEPACK];
// submit the form
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isOk(), "c'est ok");
    }


}