<?php

namespace Demo\TutorialBundle\Tests\Entity;

// use Demo\TutorialBundle\Entity\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// class AlbumRepositoryTest extends \PHPUnit_Framework_TestCase {
class AlbumRepositoryTest extends WebTestCase {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Demo\TutorialBundle\Entity\AlbumRepository
     */
    private $repository;

    public function setUp() {
        // static::$kernel = static::createKernel();
        // static::$kernel->boot();
        // $this->em = static::$kernel->getContainer()->get('doctrine')->getEntityManager();
        // $this->repository = $this->em->getRepository('DemoTutorialBundle:Album');
        $this->em = $this->getMock('EntityManager', array('persist', 'flush'));
        $this->em
             ->expects($this->any())
             ->method('persist')
             ->will($this->returnValue(true));
        $this->em
             ->expects($this->any())
             ->method('flush')
             ->will($this->returnValue(true));
        $this->doctrine = $this->getMock('Doctrine', array('getEntityManager'));
        $this->doctrine
             ->expects($this->any())
             ->method('getEntityManager')
             ->will($this->returnValue($this->em));
    }

    public function tearDown() {
        $this->em       = null;
        $this->doctrine = null;
    }

    public function test_fetch_all() {
        $albums = $this->em->getRepository('DemoTutorialBundle:Album')->fetch_all();
        $this->assertNotNull($albums);
    }

    /**
     * Test that attempting to edit a record that doesn't exist will not work.
     *
     * @expectedException ErrorException
     */
    public function test_edit_album_incorrect_id() {
        $this->em->getRepository('DemoTutorialBundle:Album')->edit_album(-1, 'Test', 'Test');
    }

    // public function testCanRetrieveAnAlbumByItsId();

    // public function testCanDeleteAnAlbumByItsId() {
    //     $mockrepo = $this->getMock('AlbumRepository');
    // }

    // public function testSaveAlbumWillInsertNewAlbumsIfTheyDontAlreadyHaveAnId();

    // public function testSaveAlbumWillUpdateExistingAlbumsIfTheyAlreadyHaveAnId();

    // public function testExceptionIsThrownWhenGettingNonexistentAlbum();
}
