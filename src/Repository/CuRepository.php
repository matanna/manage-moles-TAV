<?php

namespace App\Repository;

use App\Entity\Cu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cu[]    findAll()
 * @method Cu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cu::class);
    }

    /**
    * @return Cu[] Returns an array of Cu objects
    */
    public function findCuByName($name)
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

    /*
    public function findOneBySomeField($value): ?Cu
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
