<?php

namespace Demo\TutorialBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {
    public function testIndexActionCanBeReached() {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/album');
        $this->assertTrue($client->getResponse()->isOK());
    }

    public function testAddActionCanBeReached() {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/album/add');
        $this->assertTrue($client->getResponse()->isOK());
    }

    public function testEditActionCanBeReached() {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/album/edit');
        $this->assertTrue($client->getResponse()->isOK());
    }

    public function testDeleteActionCanBeReached() {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/album/delete');
        $this->assertTrue($client->getResponse()->isOK());
    }
}
