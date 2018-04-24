<?php

namespace App\Repository;

use App\Entity\OfferedAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OfferedAnswers|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferedAnswers|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferedAnswers[]    findAll()
 * @method OfferedAnswers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferedAnswersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OfferedAnswers::class);
    }

//    /**
//     * @return OfferedAnswers[] Returns an array of OfferedAnswers objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id_question = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OfferedAnswers
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
