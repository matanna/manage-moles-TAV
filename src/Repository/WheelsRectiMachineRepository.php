<?php

namespace App\Repository;

use App\Utils\SortWheelsRectiMachine;
use App\Entity\WheelsRectiMachine;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method WheelsRectiMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method WheelsRectiMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method WheelsRectiMachine[]    findAll()
 * @method WheelsRectiMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WheelsRectiMachineRepository extends ServiceEntityRepository
{
    private $sortWheelsRectiMachine;

    public function __construct(ManagerRegistry $registry, SortWheelsRectiMachine $sortWheelsRectiMachine)
    {
        parent::__construct($registry, WheelsRectiMachine::class);
        
        $this->sortWheelsRectiMachine = $sortWheelsRectiMachine;
    }

    /**
     * This method retrieves all wheelsRectiMachine in database for one machine and try it by position
     * @return WheelsRectiMachine[] Returns an array of WheelsRectiMachine objects
     */
    public function findAllOrderByPosition($name)
    {
        $results = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.rectiMachine', 'ma')
            ->andWhere('ma.name = :name')
            ->setParameter('name', $name)
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        return $this->sortWheelsRectiMachine->sortWheelsByPosition($results);
    }

    /**
     * This method retrieves wheelsRectiMachine who are the same machine and position
    * @return WheelsRectiMachine[] Returns an array of WheelsRectiMachine objects
    */
    public function findWheelsRectiMachineByPosition($name, $position)
    {
        $results = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.rectiMachine', 'ma')
            ->andWhere('ma.name = :name')
            ->setParameter('name', $name)
            ->andWhere('p.name = :position')
            ->setParameter('position', $position)
            ->getQuery()
            ->getResult();
        
        dump($results);

        return $results;
    }

    /**
     * This method retrieves all wheelsRectiMachine in database with try system
     * @return WheelsRectiMachine[] Returns an array of WheelsRectiMachine objects
     */
    public function findAllWheelsRectiMachine($paramTry)
    {

        $qb = $this->createQueryBuilder('me')
            ->select('p', 'me', 'ma')
            ->leftJoin('me.position', 'p')
            ->leftJoin('p.rectiMachine', 'ma');

        switch ($paramTry) {

            case 'provider': 
                $qb ->orderBy('me.provider')
                    ->addOrderBy('ma.name', 'ASC')
                    ->addOrderBy('p.name', 'ASC');
                break;

            case 'rectiMachine' : 
                $qb ->orderBy('ma.name', 'ASC')
                    ->addOrderBy('p.name', 'ASC')
                    ->addOrderBy('me.provider', 'ASC');;       
                break;
        }

        $results = $qb->getQuery()->getResult();
    
        return $results;
    }
}
