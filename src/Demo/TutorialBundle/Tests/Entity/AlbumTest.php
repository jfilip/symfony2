<?php

namespace Demo\TutorialBundle\Tests\Entity;

use Demo\TutorialBundle\Entity\Album;

class AlbumTest extends \PHPUnit_Framework_TestCase {
    public function setUp() {
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

    public function testAlbumInitialState() {
        $album = new Album();

        $this->assertNull($album->getId(), '"id" should initially be null');
        $this->assertNull($album->getArtist(), '"artist" should initially be null');
        $this->assertNull($album->getTitle(), '"title" should initially be null');
    }

    public function testSetPropertiesWorksCorrectly() {
        $album = new Album();
        $data  = array(
            'id'     => 123,
            'artist' => 'some artist',
            'title'  => 'some title'
       );

        $album->setArtist($data['artist']);
        $this->assertSame($data['artist'], $album->getArtist(), '"artist" was not set correctly');

        // $this->assertSame($data['id'], $album->id, '"id" was not set correctly');

        $album->setTitle($data['title']);
        $this->assertSame($data['title'], $album->getTitle(), '"title" was not set correctly');
    }

    // public function testFetchAllReturnsAllAlbums() {

    //     $resultSet        = new ResultSet();
    //     $mockTableTable = $this->getMock('Album', array('select'), array(), '', false);
    //     $mockTableGateway->expects($this->once())
    //                      ->method('select')
    //                      ->with()
    //                      ->will($this->returnValue($resultSet));

    //     $albumTable = new AlbumTable($mockTableGateway);

    //     $this->assertSame($resultSet, $albumTable->fetchAll());
    // }
}