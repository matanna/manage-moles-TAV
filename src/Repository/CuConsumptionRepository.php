<?php

namespace App\Repository;

use App\Entity\CuConsumption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CuConsumption|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuConsumption|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuConsumption[]    findAll()
 * @method CuConsumption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuConsumptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuConsumption::class);
    }

    // /**
    //  * @return CuConsumption[] Returns an array of CuConsumption objects
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
    public function findOneBySomeField($value): ?CuConsumption
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
