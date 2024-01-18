<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $hasher) 
{
    $this->encoder = $hasher;

}
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('toto');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->encoder->hashPassword($user, 'toto'));

        $manager->persist($user);
        $manager->flush();

    }


}