<?php

namespace UserBundle\Controller\Api;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sonata\UserBundle\Controller\Api\GroupController as BaseGroupController;
use Sonata\UserBundle\Model\GroupManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use UserBundle\Repository\GroupRepository;

class GroupController extends BaseGroupController
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * {@inheritdoc}
     * @param GroupRepository       $groupRepository
     */
    public function __construct(
        GroupManagerInterface $groupManager,
        FormFactoryInterface $formFactory,
        GroupRepository $groupRepository
    ) {
        parent::__construct($groupManager, $formFactory);
        $this->groupRepository = $groupRepository;
    }

    /**
     * Deletes a group.
     *
     * @ApiDoc(
     *  requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="group identifier"}
     *  },
     *  statusCodes={
     *      200="Returned when group is successfully deleted",
     *      400="Returned when an error has occurred while group deletion",
     *      403="Returned when an the group still have users associated with this group",
     *      404="Returned when unable to find group"
     *  }
     * )
     *
     * @param int $id A Group identifier
     *
     * @throws AccessDeniedHttpException
     *
     * @return \FOS\RestBundle\View\View
     */
    public function deleteGroupAction($id)
    {
        if ($this->groupRepository->countUsersInGroupById($id) > 0) {
            throw new AccessDeniedHttpException(sprintf('Group (%d) still has users associated.', $id));
        }

        return parent::deleteGroupAction($id);
    }
}
