<?php

namespace App\Repository;

use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Position::class);
    }

    /**
     * @return Position[] Returns an array of Position objects
     */
    public function findPositionByMachine($name)
    {
        return $this->createQueryBuilder('p')
        ->leftJoin('p.machine', 'ma')
        ->andWhere('ma.name = :name')
        ->setParameter('name', $name)
        ->getQuery()
        ->getResult()
        ;
    }

    /**
     * @return Position[] Returns an array of Position objects
     */
    public function findOnePositionPerMachine($name, $position)
    {
        $results = $this->createQueryBuilder('p')
        ->leftJoin('p.machine', 'ma')
        ->andWhere('ma.name = :name')
        ->setParameter('name', $name)

        ->andWhere('p.name = :position')
        ->setParameter('position', $position)
        ->getQuery()
        ->getResult()
        ;

        return $results[0];
    }
}
