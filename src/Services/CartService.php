<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;


readonly class CartService
{
    private ?User $user;
    public function __construct(
        private ProductsRepository     $productsRepository,
        private EntityManagerInterface $entityManager,
        private Security               $security
    )
    {
        $this->user = $this->security->getUser();
    }

    public function addProductToCart(
        string $productSize,
        string $productName,
    ): void
    {
        $product = $this->productsRepository->findOneBySizeAndName($productSize, $productName);

        $userCart = $this->user->getCart();
        $userCart->addProduct($product);
        $userCart->setTotal($userCart->getTotal() + $product->getPrice());

        $this->entityManager->persist($userCart);
        $this->entityManager->flush();
    }

    public function removeFromCart(int $productId): void
    {
        $product = $this->productsRepository->find($productId);

        $userCart = $this->user->getCart();
        $userCart->removeProduct($product);
        $userCart->setTotal($userCart->getTotal() - $product->getPrice());

        $this->entityManager->persist($userCart);
        $this->entityManager->flush();
    }

}