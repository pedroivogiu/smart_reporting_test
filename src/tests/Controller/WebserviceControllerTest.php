<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;



class WebserviceControllerTest extends WebTestCase
{
    public function testGetCurrencies()
    {
        $client = static::createClient();

        $client->request('GET', '/getCurrencies');

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue($response['status']);
    }

    public function testConvertValue()
    {

        $client = static::createClient();

        $client->request('POST', '/convert');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
?>