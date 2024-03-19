<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProductsRepository;
use App\Services\CartService;
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
        $action = $request->request->get('action');
        $productName = $request->request->get('product_name');
        $productSize = $request->request->get('product_size');

        $cartService->addProductToCart($productSize, $productName);

        if ($action == 'buy') {
            return $this->redirectToRoute('app_cart_checkout');
        }

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove', name: 'app_cart_remove')]
    public function remove(
        Request $request,
        CartService $cartService
    ): Response
    {
        $productId = $request->request->get('product_id');
        $cartService->removeFromCart($productId);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/checkout', name: 'app_cart_checkout')]
    public function checkout(ProductsRepository $productsRepository): Response
    {
        $user = $this->getUser();
        $userCart = $user->getCart();

        return $this->render('cart/checkout.html.twig', [
            'products' => $userCart->getProduct(),
            'total' => $userCart->getTotal()
        ]);
    }
}
