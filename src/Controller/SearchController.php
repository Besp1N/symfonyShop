<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Services\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    /*
     * Search is a GET method to find products by query in URL.
     * Function uses the product service
     */
    #[Route('/search', name: 'app_search', priority: 2)]
    public function index(
        Request $request,
        ProductService $productService
    ): Response
    {
        $query = $request->query->get('query');
        $products = $productService->getProductsByQuery($query);

        return $this->render('search/index.html.twig', [
            'products' => $products,
            'query' => $query
        ]);
    }

    /*
     * SearchBrand function is to find products by brands elements
     * on the bottom of home page.
     */
    #[Route('/search/brand/{brand}', name: 'app_search_brand')]
    public function searchBrands(
        string $brand,
        ProductService $productService
    ): Response
    {
        $products = $productService->getProductsByBrand($brand);

        return $this->render('search/index.html.twig', [
           'products' => $products,
           'query' => $brand
        ]);
    }
}