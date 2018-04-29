<?php

namespace UserBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends CRUDController
{
    /**
     * {@inheritdoc}
     */
    public function preDelete(Request $request, $object)
    {
        if ($this->get('group.repository')->countUsersInGroupById($object->getId()) < 1) {
            return;
        }

        $this->addFlash(
            'sonata_flash_error',
            $this->trans(
                'flash_delete_group_not_empty',
                ['%name%' => $this->escapeHtml($object->getName())],
                'messages'
            )
        );

        return $this->redirectToList();
    }
}
