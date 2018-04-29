<?php

namespace UserBundle\Model;

use Components\Model\Entity;
use Sonata\UserBundle\Entity\BaseUser;
use Sonata\UserBundle\Model\UserInterface as BaseUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields="email", message="email.invalid")
 */
class User extends BaseUser implements BaseUserInterface, Entity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @Assert\NotBlank(message="mandatory.field")
     * @Assert\Email(message="validation.invalid_email", checkMX=true)
     *
     * @var string
     */
    protected $email;

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
     * Set the UserName when setting the Email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        $this->email = $email;

        return $this;
    }
}
