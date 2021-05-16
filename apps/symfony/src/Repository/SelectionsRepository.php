<?php

namespace App\Repository;

use App\Entity\Selections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Selections|null find($id, $lockMode = null, $lockVersion = null)
 * @method Selections|null findOneBy(array $criteria, array $orderBy = null)
 * @method Selections[]    findAll()
 * @method Selections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Selections::class);
    }

    // /**
    //  * @return Selections[] Returns an array of Selections objects
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
    public function findOneBySomeField($value): ?Selections
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
