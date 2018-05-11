<?php

namespace App\Infrastructure\Domain;

use App\Domain\Repository\OfferedAnswerRepository;
use App\Domain\Entity\OfferedAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OfferedAnswer|null find($id, $lockMode = null, $lockVersion = null)
 */

class DbalOfferedAnswerRepository extends ServiceEntityRepository implements OfferedAnswerRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OfferedAnswer::class);
    }

    public function add(OfferedAnswer $offeredAnswer)
    {
        $this->getEntityManager()->persist($offeredAnswer);
        $this->getEntityManager()->flush();
    }

    public function delete(OfferedAnswer $offeredAnswer)
    {
        $this->getEntityManager()->remove($offeredAnswer);
        $this->getEntityManager()->flush();
    }
}
