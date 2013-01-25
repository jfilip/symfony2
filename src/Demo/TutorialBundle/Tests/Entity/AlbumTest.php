<?php

namespace Demo\TutorialBundle\Tests\Entity;

use Demo\TutorialBundle\Entity\Album;

class AlbumTest extends \PHPUnit_Framework_TestCase {
    public function testAlbumInitialState() {
        $album = new Album();

        $this->assertNull($album->id, '"id" should initially be null');
        $this->assertNull($album->artist, '"artist" should initially be null');
        $this->assertNull($album->title, '"title" should initially be null');
    }
}