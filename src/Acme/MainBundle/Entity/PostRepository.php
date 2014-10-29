<?php

namespace Acme\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends BaseRepository
{
    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public function getAll()
    {
        return $this->findBy([], ['created' => 'DESC']);
    }
}
