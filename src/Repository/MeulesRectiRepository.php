<?php

namespace App\Repository;

use App\Entity\MeulesRecti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeulesRecti|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeulesRecti|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeulesRecti[]    findAll()
 * @method MeulesRecti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeulesRectiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeulesRecti::class);
    }

    /**
     * @return MeulesRecti[] Returns an array of MeulesRecti objects
     */
    public function findAllOrderByPosition()
    {
        //Initialisation du méta tableau
        $tableResults = [];

        $results = $this->createQueryBuilder('m')
            ->andWhere(m.)
            ->orderBy('m.position', 'ASC')
            ->getQuery()
            ->getResult()
        ;

        //On regroupe les résultats dans un tableau qui a pour index le paramètre position de chaque objet récupéré
        //Ce tableau est lui même placé dans un méta tableau qui est retourné

        //Initialisation du tableau regroupant les objets avec la même position
        $resultPerPosition = [];
        
        foreach ($results as $result) {
            $position = $result->getPosition(); 
            $resultPerPosition[] = $result;
            $tableResults[$position[0]] = $resultPerPosition;       
        }

        return $tableResults;
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
