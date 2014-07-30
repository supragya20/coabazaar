<?php

namespace Cashonad\ProfileBundle\DataFixtures\ORM;

use Cashonad\ProfileBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        //  var_dump('getting container here');
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setUsername("Supragya Devkota");
        $user->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword('123456', $user->getSalt()));
        $user->setEmail("supragya20@gmail.com");
        $user->setAddress("NewZealand");
        $user->setMobile("985112233");

        $manager->persist($user);

        $manager->flush();
    }

}
