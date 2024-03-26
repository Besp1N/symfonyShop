<?php

namespace App\Controller\Api;

use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    /*
     * Single API endpoint to check if product is available,
     * this API was used in /{product} route to check if size is available and
     * tell that user without refresh page.
     */
    #[Route('/api/available', name: 'app_api')]
    public function index(Request $request, ProductsRepository $productsRepository): JsonResponse
    {
       $size = $request->query->get('size');
       $name = $request->query->get('name');

       $data = [
         "isAvailable" => $productsRepository->isProductAvailable($name, $size)
       ];

       return new JsonResponse($data);
    }
}
