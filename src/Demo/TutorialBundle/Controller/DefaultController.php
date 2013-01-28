<?php

namespace Demo\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Demo\TutorialBundle\Entity\Album;

class DefaultController extends Controller {
    public function indexAction() {
        $title = 'My albums';
        // $this->headTitle($title);
        // $dbobj = new Album();
        // $albums = $dbobj->findAll();
        // $repository = $this->getDoctrine()->getRepository('DemoTutorialBundle:Album');
        // $albums = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository('DemoTutorialBundle:Album')->fetch_all();

        return $this->render('DemoTutorialBundle:Default:index.html.twig', array('title' => $title, 'albums' => $albums));
        // return new Response('');
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
