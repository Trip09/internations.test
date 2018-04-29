<?php

namespace UserBundle\Repository;

interface GroupRepository
{
    /**
     * Count the Number of users in a group
     *
     * @param int $id
     *
     * @return int
     */
    public function countUsersInGroupById(int $id): int;
}
