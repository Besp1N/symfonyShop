<?php

namespace App\Controller;

use App\Entity\Products;
use App\Services\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    /*
     * Home function uses a ProductService
     * to find products and unique brands
     */
    #[Route('/', name: 'app_home')]
    public function index(
        ProductService $productService
    ): Response
    {
        return $this->render('home/index.html.twig', [
            "products" => $productService->getDisplayOnlyProducts(),
            "brands" => $productService->findUniqueBrands()
        ]);
    }

    /*
     * Classic single product page, functions gets product,
     * then renders the view with that product
     */
    #[Route('/{product}', name: 'app_home_show_one')]
    public function showOne(Products $product): Response
    {
        return $this->render('home/product.html.twig', [
            'product' => $product
        ]);
    }

}
