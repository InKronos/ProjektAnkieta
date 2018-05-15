<?php

namespace App\Infrastructure\Domain;

use App\Domain\Entity\RebateCode;
use App\Domain\Repository\RebateCodeRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RebateCode|null find($id, $lockMode = null, $lockVersion = null)
 */

class DbalRebateCodeRepository extends ServiceEntityRepository implements RebateCodeRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RebateCode::class);
    }

    public function add(RebateCode $code)
    {
        $this->getEntityManager()->persist($code);
        $this->getEntityManager()->flush();
    }

    public function update(RebateCode $code)
    {
        $this->getEntityManager()->flush();
    }
}