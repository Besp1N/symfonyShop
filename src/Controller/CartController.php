<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        $user = $this->getUser();

        $cart = [];
        if ($user instanceof User) {
            $cart = $user->getCart();
        }


        return $this->render('cart/index.html.twig', [
            "productsInCart" => $cart->getProduct(),
            "total" => $cart->getTotal()
        ]);
    }

    #[Route('/cart/update/', name: 'app_cart_add')]
    public function add(Request $request, ProductsRepository $productsRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $productName = $request->request->get('product_name');
        $productSize = $request->request->get('product_size');
        $product = $productsRepository->findOneBySizeAndName($productSize, $productName);

        if ($user instanceof User and $product) {
            $userCart = $user->getCart();
            $userCart->addProduct($product);
            $userCart->setTotal($userCart->getTotal() + $product->getPrice());

            $entityManager->persist($userCart);
            $entityManager->flush();

            return $this->redirect('/cart');
        }

        return $this->redirect('/');
    }

    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(Request $request, ProductsRepository $productsRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $productId = $request->request->get('product_id');
        $product = $productsRepository->find($productId);

        if ($user instanceof User) {
            $userCart = $user->getCart();
            $userCart->removeProduct($product);
            $userCart->setTotal($userCart->getTotal() - $product->getPrice());
            $entityManager->persist($userCart);
            $entityManager->flush();
        }

        return $this->redirect('/cart');
    }
}
