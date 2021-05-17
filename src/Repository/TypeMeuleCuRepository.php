<?php

namespace App\Repository;

use App\Entity\TypeMeuleCu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMeuleCu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMeuleCu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMeuleCu[]    findAll()
 * @method TypeMeuleCu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMeuleCuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMeuleCu::class);
    }

    // /**
    //  * @return TypeMeuleCu[] Returns an array of TypeMeuleCu objects
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
    public function findOneBySomeField($value): ?TypeMeuleCu
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
