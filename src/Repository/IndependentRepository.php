<?php

namespace App\Repository;

use App\Entity\Independent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Independent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Independent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Independent[]    findAll()
 * @method Independent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndependentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Independent::class);
    }

    // /**
    //  * @return Independent[] Returns an array of Independent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Independent
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
