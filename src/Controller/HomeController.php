<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            "products" => $productsRepository->findBy(["isDisplayOnly" => true])
        ]);
    }

    #[Route('/{product}', name: 'app_home_show_one')]
    public function showOne(Products $product): Response
    {
        return $this->render('home/product.html.twig', [
            'product' => $product
        ]);
    }
}
