<?php

namespace Demo\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Demo\TutorialBundle\Entity\Album;

class DefaultController extends Controller {
    public function indexAction() {
        // return $this->render('DemoTutorialBundle:Default:index.html.twig', array('name' => $name));
        return new Response('');
    }

    public function addAction() {

    }

    public function editAction($id) {

    }

    public function deleteAction($id) {

    }

    public function createAction() {
        $album = new Album();
        $album->setArtist('Jon Convex');
        $album->setTitle('Idoru');

        $em = $this->getDoctrine()->getManager();
        $em->persist($album);
        $em->flush();

        return new Response('Created album id '.$album->getId());
    }
}
