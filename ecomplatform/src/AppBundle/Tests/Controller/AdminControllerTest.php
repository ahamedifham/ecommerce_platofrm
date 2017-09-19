<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testDashboard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard');
    }

    public function testSellerpayments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'seller-payments');
    }

    public function testBuyerpayments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'buyer-payments');
    }

}
