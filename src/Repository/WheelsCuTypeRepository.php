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
    public function findWheelsCuType($id)
    {
        return $this->createQueryBuilder('wcut')
            ->select('wcut', 'wcu')
            ->leftJoin('wcut.wheelsCus', 'wcu')
            ->andWhere('wcut.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
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
