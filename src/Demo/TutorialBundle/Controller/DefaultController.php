<?php

namespace Demo\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Demo\TutorialBundle\Model\Album;
use Demo\TutorialBundle\Model\AlbumQuery;

class DefaultController extends Controller {
    public function indexAction() {
        $title = 'My albums';

        // Using Propel
        $albums = AlbumQuery::create()->orderByTitle()->find();

        if (!$albums) {
            throw $this->createNotFoundException('No albums found');
        }

        return $this->render('DemoTutorialBundle:Default:index.html.twig', array('title' => $title, 'albums' => $albums));
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function addAction() {
        // Using Propel
        $title = 'Add new album';

        $form = $this->createFormBuilder(new Album())
            ->add('title', 'text')
            ->add('artist', 'text')
            ->getForm();

        $params = array(
            'title' => $title,
            'form'  => $form->createView()
        );

        return $this->render('DemoTutorialBundle:Default:add.html.twig', $params);
    }

    /**
     * @Secure(roles="ROLE_USER")
     */
    public function add_saveAction(Request $request) {
        // Using Propel
        $album = new Album();

        if ($request->isMethod('POST')) {
            if ($request->get('add', 'Cancel') == 'Cancel') {
                return $this->redirect($this->generateUrl('_index'));
            }

            $form = $this->createFormBuilder($album)
                ->add('title', 'text')
                ->add('artist', 'text')
                ->getForm();

            $form->bind($request);

            if ($form->isValid()) {
                $album->save();
                return $this->redirect($this->generateUrl('_index'));
            }
        }
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
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

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function edit_saveAction(Request $request) {
        // Using Propel
        $album = new Album();

        if ($request->isMethod('POST')) {
            if ($request->get('edit', 'Cancel') == 'Cancel') {
                return $this->redirect($this->generateUrl('_index'));
            }

            $form = $this->createFormBuilder($album)
                ->add('id', 'hidden')
                ->add('title', 'text')
                ->add('artist', 'text')
                ->getForm();

            $form->bind($request);

            if ($form->isValid()) {
                $tosave = AlbumQuery::create()->findPk($album->getId());
                $tosave->setTitle($album->getTitle());
                $tosave->setArtist($album->getArtist());
                $tosave->save();
                return $this->redirect($this->generateUrl('_index'));
            }
        }
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction($id) {
        // Using Propel
        $album = AlbumQuery::create()->findPk($id);

        if (!$album) {
            throw $this->createNotFoundException('No album found for id '.$id);
        }

        $title = 'Delete album: '.$album->getArtist().' - '.$album->getTitle();

        $form = $this->createFormBuilder($album)
            ->add('id', 'hidden')
            ->getForm();

        $params = array(
            'title' => $title,
            'album' => $album,
            'form'  => $form->createView()
        );

        return $this->render('DemoTutorialBundle:Default:delete.html.twig', $params);
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function delete_saveAction(Request $request) {
        // Using Propel
        $album = new Album();

        if ($request->isMethod('POST')) {
            $form = $this->createFormBuilder($album)
                ->add('id', 'hidden')
                ->getForm();

            $form->bind($request);
            if ($form->isValid()) {
                $del = $request->get('del', 'No');

                if ($del == 'No') {
                    return $this->redirect($this->generateUrl('_index'));
                } else if ($del == 'Yes') {
                    $album->delete();
                    return $this->redirect($this->generateUrl('_index'));
                }
            }
        }
    }
}
