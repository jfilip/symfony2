<?php

namespace Demo\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $album = AlbumQuery::create()->findPk($id);

        if (!$album) {
            throw $this->createNotFoundException('No album found for id '.$id);
        }

        $title = 'Edit album: '.$album->getArtist().' - '.$album->getTitle();

        $form = $this->createFormBuilder($album)
            ->add('id', 'hidden')
            ->add('title', 'text')
            ->add('artist', 'text')
            ->getForm();

        $params = array(
            'title' => $title,
            'album' => $album,
            'form'  => $form->createView()
        );

        return $this->render('DemoTutorialBundle:Default:edit.html.twig', $params);
    }

    public function edit_saveAction(Request $request) {
        $album = new Album();

        if ($request->isMethod('POST')) {
            $form = $this->createFormBuilder($album)
                ->add('id', 'hidden')
                ->add('title', 'text')
                ->add('artist', 'text')
                ->getForm();

            $form->bind($request);
// var_dump($form);
            if ($form->isValid()) {
                $tosave = AlbumQuery::create()->findPk($album->getId());
                $tosave->setTitle($album->getTitle());
                $tosave->setArtist($album->getArtist());
                $tosave->save();
                return $this->redirect($this->generateUrl('_album'));
            }
        }

        // $album->setTitle($title);
        // $album->setArtist($artist);
        // $album->save();
    }

    public function deleteAction($id) {
        // Using Propel
        // $album = AlbumQuery::create()->findPk($id);

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
