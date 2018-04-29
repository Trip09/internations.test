<?php

namespace UserBundle\Repository;

use Components\Repository\DefaultDoctrine;

class GroupDoctrine extends DefaultDoctrine implements GroupRepository
{
    public function countUsersInGroupById(int $id): int
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder
            ->select('COUNT(users.id) as total')
            ->join('user_group.users', 'users')
            ->where('user_group.id = :id')
            ->setParameters([':id' => $id]);

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias(): string
    {
        return 'user_group';
    }
}
