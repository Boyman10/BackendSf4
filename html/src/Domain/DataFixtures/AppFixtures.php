<?php

namespace App\Domain\DataFixtures;

use App\Domain\Entity\Member;
use App\Domain\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class aimed to load default data to DB
 * @author boy
 * Date: 29/04/2018
 * Time: 15:47
 * @see https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html
 */
class AppFixtures extends Fixture
{

    private $encoder;
    private $logger;

    /**
     * Enabling Constructor  to load additional service for password encryption
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param LoggerInterface $logger
     */
    public function __construct(UserPasswordEncoderInterface $encoder, LoggerInterface $logger)
    {
        $this->encoder = $encoder;
        $this->logger;
    }

    public function load( ObjectManager $manager)
    {
        // setting up new Roles :

        $role = new Role();
        $role->setRoleName("visitor");
        $manager->persist($role);


        $role = new Role();
        $role->setRoleName("administrator");
        $manager->persist($role);


        // create 1 admin user
        $member = new Member($this->logger, null);
        $member->setUsername("toto");
        $member->setRole($role);

        // Password generation
        $password = $this->encoder->encodePassword($member, '1234');
        $member->setPassword($password);

        $manager->persist($member);

        $manager->flush();
    }


}