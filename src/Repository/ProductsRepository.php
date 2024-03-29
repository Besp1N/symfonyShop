<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\CallableParameter;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }


    public function isProductAvailable(string $name, string $size): bool
    {
        $queryBuilder = $this->createQueryBuilder('p');

        $queryBuilder
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->andWhere('p.size = :size')
            ->setParameter('size', $size)
            ->andWhere('p.isDisplayOnly = :isDisplayOnly')
            ->setParameter('isDisplayOnly', false)
            ->leftJoin('p.cart', 'c')
            ->andWhere($queryBuilder->expr()->isNull('c.id'));

        $result = $queryBuilder->getQuery()->getResult();

        return count($result) > 0;
    }

    public function findOneBySizeAndName(string $size, string $name): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.size = :size')
            ->setParameter('size', $size)
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->andWhere('p.isDisplayOnly = :isDisplayOnly')
            ->setParameter('isDisplayOnly', false)
            ->leftJoin('p.cart', 'c')
            ->andWhere('c.id IS NULL')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function findAllByName(string $name): ?  array
    {
        $result = $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->andWhere('p.isDisplayOnly = TRUE')
            ->getQuery()
            ->getResult();

        if (empty($result)) {
            return null;
        }
        return $result;
    }

    public function findUniqueBrands(): array
    {
        return $this->createQueryBuilder('p')
            ->select('DISTINCT p.brand')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    public function findProductsByBrand(string $brand): ?array
    {
        $result = $this->createQueryBuilder('p')
            ->andWhere('p.brand = :brand')
            ->setParameter('brand', $brand)
            ->andWhere('p.isDisplayOnly = TRUE')
            ->getQuery()
            ->getResult();

        if (empty($result)) {
            return null;
        }
        return $result;
    }


    //    /**
    //     * @return Products[] Returns an array of Products objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Products
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
