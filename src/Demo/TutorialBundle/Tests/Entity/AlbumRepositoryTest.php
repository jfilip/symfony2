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
    // protected $doctrine;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getEntityManager();

        // $this->em = $this->getMock('EntityManager', array('persist', 'flush'));
        // $this->em
        //      ->expects($this->any())
        //      ->method('persist')
        //      ->will($this->returnValue(true));
        // $this->em
        //      ->expects($this->any())
        //      ->method('flush')
        //      ->will($this->returnValue(true));
        // $this->doctrine = $this->getMock('Doctrine', array('getEntityManager'));
        // $this->doctrine
        //      ->expects($this->any())
        //      ->method('getEntityManager')
        //      ->will($this->returnValue($this->em));
    }

    public function tearDown() {
        $this->em       = null;
        $this->doctrine = null;
    }

    public function test_fetch_all() {
        var_dump($this->em->getRepository('DemoTutorialBundle:Album')->fetch_all());
    }
}
