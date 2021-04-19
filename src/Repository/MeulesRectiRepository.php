<?php

namespace App\Repository;

use App\Entity\MeulesRecti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeulesRecti|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeulesRecti|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeulesRecti[]    findAll()
 * @method MeulesRecti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeulesRectiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeulesRecti::class);
    }

    // /**
    //  * @return MeulesRecti[] Returns an array of MeulesRecti objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MeulesRecti
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
