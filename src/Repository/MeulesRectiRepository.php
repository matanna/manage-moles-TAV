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
     * This method retrieves all meulesRecti in database for one machine and try it per position
     * @return MeulesRecti[] Returns an array of MeulesRecti objects
     */
    public function findAllOrderByPosition($name)
    {
        $results = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.machine', 'ma')
            ->andWhere('ma.name = :name')
            ->setParameter('name', $name)
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        return $this->tryMolesResults->tryMolesPerPosition($results);
    }

    /**
     * This method retrieves meulesRecti who are the same machine and position
    * @return MeulesRecti[] Returns an array of MeulesRecti objects
    */
    public function findMeulesRectiPerPosition($name, $position)
    {
        $results = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.machine', 'ma')
            ->andWhere('ma.name = :name')
            ->setParameter('name', $name)
            ->andWhere('p.name = :position')
            ->setParameter('position', $position)
            ->getQuery()
            ->getResult();
            
        return $results;
    }

    /**
     * This method retrieves all meulesRecti in database with try system
     * @return MeulesRecti[] Returns an array of MeulesRecti objects
     */
    public function findAllMeulesRecti($paramTry)
    {
        dump($paramTry);

        $qb = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.machine', 'ma');

        switch ($paramTry) {

            case 'fournisseur': 
                $qb ->orderBy('me.fournisseur')
                    ->addOrderBy('ma.name', 'ASC')
                    ->addOrderBy('p.name', 'ASC');
                break;

            case 'machine' : 
                $qb ->orderBy('ma.name', 'ASC')
                    ->addOrderBy('p.name', 'ASC')
                    ->addOrderBy('me.fournisseur', 'ASC');;       
                break;
        }

        $results = $qb->getQuery()->getResult();
    
        return $results;
    }
}
