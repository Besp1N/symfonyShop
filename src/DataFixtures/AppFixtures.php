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

        // images/products/adidas_shirt1jpg.webp

        $productForDisplay2 = new Products();
        $productForDisplay2->setIsDisplayOnly(true);
        $productForDisplay2->setImage('images/products/adidas_shirt1jpg.webp');
        $productForDisplay2->setPrice(150.00);
        $productForDisplay2->setType('shirt');
        $productForDisplay2->setBrand('Adidas');
        $productForDisplay2->setDescription('cool shirt');
        $productForDisplay2->setSize('S');
        $productForDisplay2->setName('Adidas Shirt 1');

        $productForBuyDisplay2 = new Products();
        $productForBuyDisplay2->setIsDisplayOnly(false);
        $productForBuyDisplay2->setImage('images/products/adidas_shirt1jpg.webp');
        $productForBuyDisplay2->setPrice(150.00);
        $productForBuyDisplay2->setType('shirt');
        $productForBuyDisplay2->setBrand('Adidas');
        $productForBuyDisplay2->setDescription('cool shirt');
        $productForBuyDisplay2->setSize('S');
        $productForBuyDisplay2->setName('Adidas Shirt 1');

        // images/products/puma_shirt1.jpeg

        $productForDisplay3 = new Products();
        $productForDisplay3->setIsDisplayOnly(true);
        $productForDisplay3->setImage('images/products/puma_shirt1.jpeg');
        $productForDisplay3->setPrice(200.00);
        $productForDisplay3->setType('shirt');
        $productForDisplay3->setBrand('Puma');
        $productForDisplay3->setDescription('cool shirt');
        $productForDisplay3->setSize('L');
        $productForDisplay3->setName('Puma Shirt 1');

        $productForBuyDisplay3 = new Products();
        $productForBuyDisplay3->setIsDisplayOnly(false);
        $productForBuyDisplay3->setImage('images/products/puma_shirt1.jpeg');
        $productForBuyDisplay3->setPrice(200.00);
        $productForBuyDisplay3->setType('shirt');
        $productForBuyDisplay3->setBrand('Puma');
        $productForBuyDisplay3->setDescription('cool shirt');
        $productForBuyDisplay3->setSize('L');
        $productForBuyDisplay3->setName('Puma Shirt 1');




        $manager->persist($user1);
        $manager->persist($productForDisplay1);
        $manager->persist($productForBuyDisplay1);
        $manager->persist($productForDisplay2);
        $manager->persist($productForBuyDisplay2);
        $manager->persist($productForDisplay3);
        $manager->persist($productForBuyDisplay3);
        $manager->flush();



    }
}
