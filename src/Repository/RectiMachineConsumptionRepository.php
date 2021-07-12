<?php

namespace App\Repository;

use App\Entity\RectiMachineConsumption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RectiMachineConsumption|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectiMachineConsumption|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectiMachineConsumption[]    findAll()
 * @method RectiMachineConsumption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectiMachineConsumptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectiMachineConsumption::class);
    }

    // /**
    //  * @return RectiMachineConsumption[] Returns an array of Consumption objects
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
    public function findOneBySomeField($value): ?Consumption
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
