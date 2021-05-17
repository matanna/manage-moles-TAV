<?php

namespace App\Repository;

use App\Entity\TypeMeule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMeule|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMeule|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMeule[]    findAll()
 * @method TypeMeule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMeuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMeule::class);
    }

    // /**
    //  * @return TypeMeule[] Returns an array of TypeMeule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeMeule
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
