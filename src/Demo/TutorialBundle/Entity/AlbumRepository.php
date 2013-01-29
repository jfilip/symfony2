<?php

namespace Demo\TutorialBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AlbumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlbumRepository extends EntityRepository {
    public function fetch_all() {
        $query = "SELECT a
                  FROM DemoTutorialBundle:Album a
                  ORDER BY a.title ASC";

        return $this->getEntityManager()
            ->createQuery($query)
            ->getResult();
    }

    /**
     * Get a single album record from the DB based on it's ID value
     *
     * @param int $id The ID of the database record.
     * @return object The Album() object that was found.
     */
    public function get_album($id) {
        return $this->getEntityManager()->find($id);
    }

    /**
     * Edit (save) an album record back to the database.
     *
     * @param int $id The ID of the database record.
     * @param string $name The name field value to update
     * @param string $title The title field value to update
     * @return bool True on success, False otherwise
     */
    public function edit_album($id, $name, $title) {
        $em = $this->getEntityManager();
        $product = $em->find($id);
        $product->setName($name);
        $product->setTitle($title);
        try {
            $em->flush();
        } catch (\Doctrine\ORM\OptimisticLockException $e) {
            return false;
        }

        return true;
    }
}
