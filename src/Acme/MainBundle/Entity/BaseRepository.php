<?php
/**
 * Created by PhpStorm.
 * User: sergey@slepokurov.com
 * Date: 29.10.2014
 * Time: 13:05
 */

namespace Acme\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class BaseRepository extends EntityRepository {
    public function delete($entity)
    {
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
    }

    public function deleteById($idValue, $idColumn = 'id')
    {
        $tableName = $this->getEntityManager()->getClassMetadata($this->getEntityName())->getTableName();
        $this->getEntityManager()->getConnection()->delete($tableName, [$idColumn => $idValue]);
    }

    public function persist($entity) {
        $em = $this->getEntityManager();
        $em->persist($entity);
    }

    public function flush() {
        $this->getEntityManager()->flush();
    }

    public function attach($entity)
    {
        $em = $this->getEntityManager();
        return $em->merge($entity);
    }

    public function refresh($entity)
    {
        $em = $this->getEntityManager();
        $em->refresh($entity);
    }

    public function save($entity)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    public function getById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function getCount() {
        $query = $this->createQueryBuilder('q')->select("count(q.id)");
        $count = 0;
        try {
            $count = $query->getQuery()->getSingleScalarResult();
        } catch (NoResultException $ex) {
            $count = 0;
        }
        return $count;
    }

    /**
     * @param int $take
     * @param int $skip
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLimited($take = 20, $skip = 0)
    {
        $query = $this->createQueryBuilder('q');
        $query->setMaxResults($take);
        $query->setFirstResult($skip);
        return $query->getQuery()->getResult();
    }
} 