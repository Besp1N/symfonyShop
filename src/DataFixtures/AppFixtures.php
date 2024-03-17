<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\Products;
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
        $user1 = new User();
        $user1->setName("Kacper");
        $user1->setLastname("Karabinowski");
        $user1->setEmail("kackar87@wp.pl");
        $user1->setPassword($this->userPasswordHasher->hashPassword($user1, "12345678"));
        $user1->setRoles(['ROLE_USER']);
        $user1->setIsActive(true);
        $user1->setActivationKey("test");

        $user1Cart = new Cart();
        $user1Cart->setTotal(0.00);
        $user1->setCart($user1Cart);

        $productForDisplay1 = new Products();
        $productForDisplay1->setIsDisplayOnly(false);
        $productForDisplay1->setImage('images/products/nike_shirt1.jpg');
        $productForDisplay1->setPrice(120.00);
        $productForDisplay1->setType('shirt');
        $productForDisplay1->setBrand('Nike');
        $productForDisplay1->setDescription('cool shirt');
        $productForDisplay1->setSize('XL');
        $productForDisplay1->setName('Nike shirt 1');

        $productForBuyDisplay1 = new Products();
        $productForBuyDisplay1->setIsDisplayOnly(true);
        $productForBuyDisplay1->setImage('images/products/nike_shirt1.jpg');
        $productForBuyDisplay1->setPrice(120.00);
        $productForBuyDisplay1->setType('shirt');
        $productForBuyDisplay1->setBrand('Nike');
        $productForBuyDisplay1->setDescription('cool shirt');
        $productForBuyDisplay1->setSize('XL');
        $productForBuyDisplay1->setName('Nike shirt 1');

        $manager->persist($user1);
        $manager->persist($productForDisplay1);
        $manager->persist($productForBuyDisplay1);
        $manager->flush();



    }
}
