<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    public function load(EntityManagerInterface|ObjectManager $manager): void
    {
        $user = new User();
        $user->setName("Kacper");
        $user->setLastname("Karabinowski");
        $user->setEmail("kackar87@wp.pl");
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "12345678"));
        $user->setRoles(['ROLE_USER']);
        $user->setIsActive(true);
        $user->setActivationKey("test");

        $manager->persist($user);
        $manager->flush();



    }
}
