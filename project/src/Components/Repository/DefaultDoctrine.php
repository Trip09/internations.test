<?php

namespace Components\Repository;

use Components\Model\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class DefaultDoctrine extends EntityRepository
{
    /**
     * Find an Entity by its Id
     *
     * @param integer $id
     *
     * @return Entity $object
     */
    public function findById(int $id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * Flush the entity Manager
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param Entity $object
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function persist(Entity $object)
    {
        $this->getEntityManager()->persist($object);
    }

    /**
     * @param Entity $object
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Entity $object)
    {
        $this->getEntityManager()->remove($object);
    }

    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }

    /**
     * @return QueryBuilder
     */
    protected function getCollectionQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }

    /**
     * Default Table Alias
     *
     * @param $field
     *
     * @return string
     */
    protected function getPropertyName($field)
    {
        if (false === strpos($field, '.')) {
            return $this->getAlias() . '.' . $field;
        }

        return $field;
    }

    /**
     * Default Table Alias
     *
     * @return string
     */
    protected function getAlias()
    {
        return 'default';
    }
}