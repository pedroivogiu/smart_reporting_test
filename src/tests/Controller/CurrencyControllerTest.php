<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CurrencyControllerTest extends WebTestCase
{
    public function testShowPage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetValues()
    {
        $client = static::createClient(array(
		    'environment' => 'test',
		    'debug'       => false,
		));

        $client->request('GET', '/getValues');

        $resultJson = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('initialCurrency', $resultJson[0]);
    }
}
?>