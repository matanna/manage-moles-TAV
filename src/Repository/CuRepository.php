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
    * @return Cu Returns an array of Cu objects
    */
    public function findCuByName($name)
    {

        $result =  $this->createQueryBuilder('cu')
            ->select('cu', 'wcut', 'wcu', 'f', 'c')
            ->leftJoin('cu.wheelsCuTypes', 'wcut')
            ->leftJoin('wcut.wheelsCus', 'wcu')
            ->leftJoin('wcu.provider', 'f')
            ->leftJoin('wcut.cuCategory', 'c')
            ->andWhere('cu.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult()
        ;

        return $result[0];
    }

    /**
    * @return Cus Returns an array of Cu objects
    */
    public function findAllCus()
    {

        $results =  $this->createQueryBuilder('cu')
            ->select('cu', 'wcut')
            ->leftJoin('cu.wheelsCuTypes', 'wcut')
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
