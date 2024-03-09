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

        $product1 = new Products();
        $product1->setName("Nike Shirt");
        $product1->setSize("XL");
        $product1->setPrice(120.00);
        $product1->setBrand("Nike");
        $product1->setDescription("Cool shirt");
        $product1->setImage("images/products/nike_shirt1.jpg");
        $product1->setIsDisplayOnly(true);
        $product1->setType("shirt");


        $manager->persist($user1);
        $manager->persist($product1);
        $manager->flush();



    }
}
