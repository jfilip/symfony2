<?php

namespace Demo\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Propel1\runtime\query\ModelCriteria;
use Symfony\Bridge\Propel1\Form\DataTransformerl;
use Demo\TutorialBundle\Model\Album;
use Demo\TutorialBundle\Model\AlbumQuery;

class DefaultController extends Controller {
    public function indexAction() {
        $title = 'My albums';

        // Using Doctrine
        // $dbobj = new Album();
        // $albums = $dbobj->findAll();
        // $repository = $this->getDoctrine()->getRepository('DemoTutorialBundle:Album');
        // $albums = $repository->findAll();

        // $em = $this->getDoctrine()->getManager();
        // $albums = $em->getRepository('DemoTutorialBundle:Album')->fetch_all();

        // Using Propel
        $albums = AlbumQuery::create()->orderByTitle()->find();

        if (!$albums) {
            throw $this->createNotFoundException('No albums found');
        }

        return $this->render('DemoTutorialBundle:Default:index.html.twig', array('title' => $title, 'albums' => $albums));
    }

    public function addAction() {
        // Using Propel
        // $album = new Album();
        // $album->setTitle($title);
        // $album->setArtist($artist);
        // $album->save();
    }

    public function editAction($id) {
        // Using Propel
        // $album = AlbumQuery::create()->findByPk($id);

        // if (!$album) {
        //     throw $this->createNotFoundException('No album found for id '.$id);
        // }

        // $album->setTitle($title);
        // $album->setArtist($artist);
        // $album->save();
    }

    public function deleteAction($id) {
        // Using Propel
        // $album = AlbumQuery::create()->findByPk($id);

        // if (!$album) {
        //     throw $this->createNotFoundException('No album found for id '.$id);
        // }

        // $album->delete();
    }

    public function createAction() {
        // Using propel
        $album = new Album();
        $album->setArtist('Jon Convex');
        $album->setTitle('Idoru');

        $album->save();

        return new Response('Created album id '.$album->getId());
    }
}
