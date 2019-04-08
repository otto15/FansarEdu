<?php

namespace App\Repository;

use App\Entity\AnswerChoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AnswerChoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerChoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerChoice[]    findAll()
 * @method AnswerChoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerChoiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AnswerChoice::class);
    }

    // /**
    //  * @return AnswerChoice[] Returns an array of AnswerChoice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnswerChoice
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
