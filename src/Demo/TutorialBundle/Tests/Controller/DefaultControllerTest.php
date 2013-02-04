<?php

namespace Demo\TutorialBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /** @var object The web browser client object that we will make requests through. */
    private $client;

    /**
     * @see Symfony\Bundle\FrameworkBundle\Test\WebTestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    /**
     * @see Symfony\Bundle\FrameworkBundle\Test\WebTestCase::tearDown()
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->client);
    }

    /**
     * Provide an array of input data specifying a URL path and whether the request should work or not.
     * Data is meant to be used to test for accessing various URLs while logged out of the system.
     *
     * @return array An array of input data
     */
    public function loggedOutUrlPathsProvider()
    {
        return array(
            array('/', 'ok'),
            array('album/add', 'redirect')
        );
    }

    public function testIndexActionCanBeReached()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOK());
    }

    /**
     * Test attempting to access URLs while not logged in as an authenticated user.
     *
     * @dataProvider loggedOutUrlPathsProvider
     * @param string $url    The URL path to access
     * @param string $status Whether the attempt should be successful or not
     */
    public function testActionsWhileLoggedOut($url, $status)
    {
        $this->client->request('GET', $url);

        switch ($status) {
            case 'ok':
                $this->assertTrue($this->client->getResponse()->isOk());
                break;
            case 'redirect':
                $this->assertTrue($this->client->getResponse()->isRedirect());
                break;
            case 'forbidden':
                $this->assertTrue($this->client->getResponse()->isForbidden());
                break;
        }
    }
}
