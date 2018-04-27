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
     * Get id
     *
     * @return integer $id
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}