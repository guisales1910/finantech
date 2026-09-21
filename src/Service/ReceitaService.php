<?php

namespace App\Service;

use AllowDynamicProperties;
use App\Entity\Receita;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReceitaRepository;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Void_;

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

    public function ReceitasUltimos30dias(): Array {

        return $this->receitaRepository->listarReceitasUltimos30Dias();
    }

    public function editarReceita(
        int $id,
        string $descricao,
        string $valor,
        \DateTime $data
    ): Receita {

        // Busca a receita pelo ID através do Repository.
        $receita = $this->receitaRepository->buscarPorId($id);

        // Verifica se encontrou.
        if (!$receita) {
            throw new \Exception('Receita não encontrada.');
        }

        // Altera os dados.
        $receita->setDescricao($descricao);
        $receita->setValor($valor);
        $receita->setData($data);

        // Salva as alterações.
        $this->receitaRepository->salvarReceita($receita);

        return $receita;
    }

    public function excluirReceita(Receita $receita): Void
    {
        $this->entityManager->remove($receita);
        $this->entityManager->flush();
    }


}

