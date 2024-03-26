<?php

namespace App\Services;

use App\Repository\ProductsRepository;

readonly class ProductService
{
    public function __construct(
        private ProductsRepository $productsRepository
    )
    {}

    public function getDisplayOnlyProducts(): array
    {
        return $this->productsRepository->findBy(["isDisplayOnly" => true]);
    }

    public function findUniqueBrands(): array
    {
        return $this->productsRepository->findUniqueBrands();
    }

    public function getProductsByQuery(string $query): array
    {
        return $this->productsRepository->findAllByName($query);
    }

    public function getProductsByBrand(string $brand): array
    {
        return $this->productsRepository->findProductsByBrand($brand);
    }
}