<?php

namespace Demo\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Testing for the SecurityController code
 */
class SecurityControllerTest extends WebTestCase
{
    /**
     * Test that the login path works correctly.
     */
    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertTrue($client->getResponse()->isOK());
        $this->assertEquals(1, $crawler->filter('html:contains("Username")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Password")')->count());
    }

    /**
     * Test that the logout path works correctly.
     */
    public function testLogout()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/logout');
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}
