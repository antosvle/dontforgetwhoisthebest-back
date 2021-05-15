<?php

namespace App\Repository;

use App\Entity\Stages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stages[]    findAll()
 * @method Stages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stages::class);
    }

    // /**
    //  * @return Stages[] Returns an array of Stages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stages
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
