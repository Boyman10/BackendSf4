<?php

namespace App\Domain\DataFixtures;

use App\Domain\Entity\Member;
use App\Domain\Entity\Role;
use App\Domain\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
    private $roleRepository;

    /**
     * Enabling Constructor  to load additional service for password encryption
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param RoleRepository $roleRep
     */
    public function __construct(UserPasswordEncoderInterface $encoder, RoleRepository $roleRep)
    {
        $this->encoder = $encoder;
        $this->roleRepository = $roleRep;
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
        $member = new Member( $this->roleRepository);
        $member->setUsername("toto");
        $member->setEmail("toto@myemail.com");
        $member->setRole($role);

        // Password generation
        $password = $this->encoder->encodePassword($member, '1234');
        $member->setPassword($password);

        $manager->persist($member);

        $manager->flush();
    }


}