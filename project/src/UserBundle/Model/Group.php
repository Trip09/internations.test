<?php

namespace UserBundle\Model;

use Components\Model\Entity;
use Sonata\UserBundle\Entity\BaseGroup;

class Group extends BaseGroup implements Entity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var User[]
     */
    protected $users;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param User[] $users
     *
     * @return $this
     */
    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }


}