<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator as Faker;
use Faker\Provider\Lorem;
use Faker\Provider\pt_BR\Internet;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\PhoneNumber;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Model\Group;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function getOrder()
    {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $groups = [];
        foreach (['Designers', 'Developers'] as $key => $name) {
            $groups[] = new Group($name);
            $manager->persist($groups[$key]);
        }

        $userManager = $this->getUserManager();
        $faker       = new Faker();
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Internet($faker));
        $faker->addProvider(new Lorem($faker));

        $user = $userManager->createUser();
        $user->setEmail('admin@internationals.com');
        $user->setFirstname('I am an');
        $user->setLastname('admin');

        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setSuperAdmin(true);

        $userManager->updateUser($user, false);

        foreach (range(1, 20) as $id) {
            $user = $userManager->createUser();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail('user-' . $id . '@internationals.com');
            $user->addGroup($groups[($id % 2 == 0) ? 0 : 1]);
            $user->setPlainPassword('user-' . $id);
            $user->setEnabled(true);

            $userManager->updateUser($user, false);
        }

        $manager->flush();
    }

    /**
     * @return \FOS\UserBundle\Model\UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->container->get('fos_user.user_manager');
    }
}
