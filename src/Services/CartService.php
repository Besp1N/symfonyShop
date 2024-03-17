<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;


readonly class CartService
{
    public function __construct(
        private ProductsRepository     $productsRepository,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function addProductToCart(
        User $user,
        string $productSize,
        string $productName,
    ): void
    {
        $product = $this->productsRepository->findOneBySizeAndName($productSize, $productName);

        $userCart = $user->getCart();
        $userCart->addProduct($product);
        $userCart->setTotal($userCart->getTotal() + $product->getPrice());

        $this->entityManager->persist($userCart);
        $this->entityManager->flush();
    }

    public function removeFromCart(User $user, int $productId): void
    {
        $product = $this->productsRepository->find($productId);

        $userCart = $user->getCart();
        $userCart->removeProduct($product);
        $userCart->setTotal($userCart->getTotal() - $product->getPrice());

        $this->entityManager->persist($userCart);
        $this->entityManager->flush();
    }

}