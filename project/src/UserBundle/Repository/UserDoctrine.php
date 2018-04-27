<?php

namespace UserBundle\Repository;

use Components\Repository\DefaultDoctrine;

class UserDoctrine extends DefaultDoctrine
{
    /**
     * @inheritdoc
     */
    public function findOneByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    protected function getAlias()
    {
        return 'user';
    }
}
