<?php

namespace App\Domain\DataFixtures;

use App\Entity\Member;
use App\Entity\Role;
use App\Repository\RoleRepository;
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

    /**
     * Enabling Constructor  to load additional service for password encryption
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load( ObjectManager $manager)
    {
        // setting up new Role :
        $role = new Role();
        $role->setRoleName("administrator");
        $manager->persist($role);


        // create 1 admin user
        $member = new Member();
        $member->setUsername("toto");
        $member->setRole($role);

        // Password generation
        $password = $this->encoder->encodePassword($member, '1234');
        $member->setPass($password);

        $manager->persist($member);

        $manager->flush();
    }


}