<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityAccessTest extends WebTestCase
{
    public function testAccessResservation(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/reservation/new');

        $this->assertResponseRedirects('/login');
    }
    public function testAccessNewTrajet()
    {
        $client = static::createClient();
        $client->request('GET', '/trajet/new');

        $this->assertResponseRedirects('/login');
    }
}
