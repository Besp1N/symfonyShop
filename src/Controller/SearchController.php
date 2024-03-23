<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search', priority: 2)]
    public function index(Request $request, ProductsRepository $productsRepository): Response
    {
        $query = $request->query->get('query');

        $products = $productsRepository->findAllByName($query);

        return $this->render('search/index.html.twig', [
            'products' => $products,
            'query' => $query
        ]);
    }

}