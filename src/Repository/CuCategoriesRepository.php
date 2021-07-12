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

    /**
     * @return CuCategories[] Returns an array of CuCategories objects
     */
    public function findCuCategoriesByCu($cuName)
    {
        return $this->createQueryBuilder('c')
            ->select('c', 'wcut', 'cu')
            ->leftJoin('c.wheelsCuTypes', 'wcut')
            ->leftJoin('wcut.cu', 'cu')
            ->andWhere('cu.name = :cuName')
            ->setParameter('cuName', $cuName)
            ->getQuery()
            ->getResult()
        ;
    }
    

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
