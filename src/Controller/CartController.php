<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\User;
use App\Repository\ProductsRepository;
use App\Services\CartService;
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
    public function add(
        Request $request,
        CartService $cartService
    ): Response
    {
        $user = $this->getUser();

        if ($user instanceof User) {
            $productName = $request->request->get('product_name');
            $productSize = $request->request->get('product_size');
            $cartService->addProductToCart($user, $productSize, $productName);
        }

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(
        Request $request,
        CartService $cartService
    ): Response
    {
        $user = $this->getUser();

        if ($user instanceof User) {
            $productId = $request->request->get('product_id');
            $cartService->removeFromCart($user, $productId);
        }

        return $this->redirectToRoute('app_cart');
    }
}
