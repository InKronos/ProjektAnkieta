<?php

namespace App\Repository;

use App\Entity\RebateCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RebateCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method RebateCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method RebateCode[]    findAll()
 * @method RebateCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RebateCodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RebateCode::class);
    }

//    /**
//     * @return RebateCode[] Returns an array of RebateCode objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RebateCode
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
