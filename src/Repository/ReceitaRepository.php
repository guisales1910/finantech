<?php

namespace App\Repository;

use App\Entity\Receita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Receita>
 */
class ReceitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Receita::class);
    }

    public function salvarReceita(Receita $receita): void
    {
        $this->getEntityManager()->persist($receita);
        $this->getEntityManager()->flush();
    }

}
