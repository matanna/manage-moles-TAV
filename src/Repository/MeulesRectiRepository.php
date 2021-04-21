<?php

namespace App\Repository;

use App\Entity\Machine;
use App\Entity\MeulesRecti;
use App\Utils\TryMolesResults;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method MeulesRecti|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeulesRecti|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeulesRecti[]    findAll()
 * @method MeulesRecti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeulesRectiRepository extends ServiceEntityRepository
{
    private $tryMolesResults;

    public function __construct(ManagerRegistry $registry, TryMolesResults $tryMolesResults)
    {
        parent::__construct($registry, MeulesRecti::class);
        
        $this->tryMolesResults = $tryMolesResults;
    }

    /**
     * @return MeulesRecti[] Returns an array of MeulesRecti objects
     */
    public function findAllOrderByPosition($name)
    {
        
        $results = $this->createQueryBuilder('me')
            ->leftJoin('me.machine', 'ma')
            ->andWhere('ma.name = :name')
            ->setParameter('name', $name)
            ->orderBy('me.position', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        
        return $this->tryMolesResults->tryMolesPerPosition($results);

    }

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
