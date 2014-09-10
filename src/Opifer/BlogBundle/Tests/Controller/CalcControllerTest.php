<?php

namespace Opifer\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalcControllerTest extends WebTestCase
{
    public function testCalculate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calculate');
    }

}
