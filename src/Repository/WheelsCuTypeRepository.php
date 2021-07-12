<?php

namespace App\Repository;

use App\Entity\WheelsCuType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WheelsCuType|null find($id, $lockMode = null, $lockVersion = null)
 * @method WheelsCuType|null findOneBy(array $criteria, array $orderBy = null)
 * @method WheelsCuType[]    findAll()
 * @method WheelsCuType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WheelsCuTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WheelsCuType::class);
    }

    /**
     * @return WheelsCuType[] Returns an array of WheelsCuType objects
     */
    public function findWheelsCuTypeByCu($cuName)
    {
        $result = $this->createQueryBuilder('wcut')
            ->select('wcut', 'cu')
            ->leftJoin('wcut.cu', 'cu')
            ->andWhere('cu.name = :name')
            ->setParameter('name', $cuName)
            ->orderBy('wcut.type', 'DESC')
            ->getQuery()
            ->getResult()
        ;

        if ($result === []) {
            return null;
        }
        
        return $result;
    }

    /**
     * @return WheelsCuType[] Returns an array of WheelsCuType objects
     */
    public function findWheelsCuTypeByCuAndByCategory($cuName, $categoryName)
    {
        $result = $this->createQueryBuilder('wcut')
            ->select('wcut', 'cu', 'c')
            ->leftJoin('wcut.cu', 'cu')
            ->leftJoin('wcut.cuCategory', 'c')
            ->andWhere('cu.name = :name')
            ->andWhere('c.name = :categoryName')
            ->setParameter('name', $cuName)
            ->setParameter('categoryName', $categoryName)
            ->orderBy('wcut.type', 'ASC')
            ->getQuery()
            ->getResult()
        ;

        if ($result === []) {
            return null;
        }
        
        return $result;
    }

    /**
     * @return WheelsCuType[] Returns an array of WheelsCuType objects
     */
    public function findWheelsCuType($id)
    {
        $result = $this->createQueryBuilder('wcut')
            ->select('wcut', 'wcu', 'p')
            ->leftJoin('wcut.wheelsCus', 'wcu')
            ->leftJoin('wcu.provider', 'p')
            ->andWhere('wcut.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if ($result === []) {
            return null;
        }
        
        return $result[0];
    }

    /*
    public function findOneBySomeField($value): ?WheelsCuType
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
