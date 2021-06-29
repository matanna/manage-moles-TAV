<?php

namespace App\Repository;

use App\Entity\RectiMachine;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method RectiMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectiMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectiMachine[]    findAll()
 * @method RectiMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectiMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectiMachine::class);
    }

    // /**
    //  * @return RectiMachine[] Returns an array of RectiMachine objects
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
    public function findOneBySomeField($value): ?RectiMachine
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
