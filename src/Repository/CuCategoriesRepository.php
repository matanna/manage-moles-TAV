<?php

namespace App\Repository;

use App\Entity\CuCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CuCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuCategories[]    findAll()
 * @method CuCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuCategories::class);
    }

    // /**
    //  * @return CuCategories[] Returns an array of CuCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CuCategories
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
