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

        $product3 = new Products();
        $product3->setName("Nike Shirt 2");
        $product3->setSize("XL");
        $product3->setPrice(120.00);
        $product3->setBrand("Nike");
        $product3->setDescription("Cool shirt");
        $product3->setImage("images/products/nike_shirt1.jpg");
        $product3->setIsDisplayOnly(true);
        $product3->setType("shirt");

        $product4 = new Products();
        $product4->setName("Nike Shirt 2");
        $product4->setSize("XL");
        $product4->setPrice(120.00);
        $product4->setBrand("Nike");
        $product4->setDescription("Cool shirt");
        $product4->setImage("images/products/nike_shirt1.jpg");
        $product4->setIsDisplayOnly(true);
        $product4->setType("shirt");

        $product5 = new Products();
        $product5->setName("Nike Shirt 2");
        $product5->setSize("XL");
        $product5->setPrice(120.00);
        $product5->setBrand("Nike");
        $product5->setDescription("Cool shirt");
        $product5->setImage("images/products/nike_shirt1.jpg");
        $product5->setIsDisplayOnly(true);
        $product5->setType("shirt");

        $product2 = new Products();
        $product2->setName("Nike Shirt");
        $product2->setSize("XL");
        $product2->setPrice(120.00);
        $product2->setBrand("Nike");
        $product2->setDescription("Cool shirt");
        $product2->setImage("images/products/nike_shirt1.jpg");
        $product2->setIsDisplayOnly(false);
        $product2->setType("shirt");

        $manager->persist($user1);
        $manager->persist($product1);
        $manager->persist($product2);
        $manager->persist($product3);
        $manager->persist($product4);
        $manager->persist($product5);
        $manager->flush();



    }
}
