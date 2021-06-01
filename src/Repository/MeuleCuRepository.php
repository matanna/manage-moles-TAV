<?php

namespace App\Repository;

use App\Entity\MeuleCu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeuleCu|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeuleCu|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeuleCu[]    findAll()
 * @method MeuleCu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeuleCuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeuleCu::class);
    }

    // /**
    //  * @return MeuleCu[] Returns an array of MeuleCu objects
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
    public function findOneBySomeField($value): ?MeuleCu
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * @return Cu Returns an array of MeuleCu objects
    */
    public function findMolesCuByTypical($cuName, $typeMeule, $typical)
    {

        $result =  $this->createQueryBuilder('mcu')
            ->select('mcu', 'tcu', 'cu')
            ->leftJoin('mcu.typeMeuleCu', 'tcu')
            ->leftJoin('tcu.cu', 'cu')
            ->andWhere('tcu.typical = :typical')
            ->andWhere('tcu.typeMeule = :typeMeule')
            ->andWhere('cu.name = :cuName')
            ->setParameter('typical', $typical)
            ->setParameter('typeMeule', $typeMeule)
            ->setParameter('cuName', $cuName)
            ->getQuery()
            ->getResult()
        ;
        return $result;
    }
}
