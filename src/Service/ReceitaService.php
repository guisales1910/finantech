<?php

namespace App\Service;

use AllowDynamicProperties;
use App\Entity\Receita;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReceitaRepository;

#[AllowDynamicProperties]
class ReceitaService
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
        $this->receitaRepository = $this->entityManager->getRepository(Receita::class);
    }

    public function adicionarReceita(string $descricao, string $valor, \DateTime $data): Receita {
        $receita = new Receita();
        $receita->setDescricao($descricao);
        $receita->setValor($valor);
        $receita->setData($data);

        $this->receitaRepository->salvarReceita($receita);

        return $receita;
    }
}

