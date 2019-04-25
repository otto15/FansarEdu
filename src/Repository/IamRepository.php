<?php

namespace App\Repository;

use App\Entity\Iam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Iam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Iam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Iam[]    findAll()
 * @method Iam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Iam::class);
    }

    // /**
    //  * @return Iam[] Returns an array of Iam objects
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
    public function findOneBySomeField($value): ?Iam
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
