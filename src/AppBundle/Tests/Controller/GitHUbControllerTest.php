<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GitHUbControllerTest extends WebTestCase
{
    public function testShowtable()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showTable');
    }

}
