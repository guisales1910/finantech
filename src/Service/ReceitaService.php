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

    public function buscarPorId(int $id): ?Receita
    {
        return $this->receitaRepository->buscarPorId($id);
    }

    public function excluirReceita(Receita $receita): Void
    {
        $this->entityManager->remove($receita);
        $this->entityManager->flush();
    }

    public function calcularTotalUltimos30Dias(): float
    {
        // Busca no Repository todas as receitas cadastradas
        // dentro dos últimos 30 dias.
        //
        // O retorno é um array de objetos Receita.
        $receitas = $this->receitaRepository->listarReceitasUltimos30Dias();

        // Criamos uma variável para armazenar o total.
        // Começamos com 0 porque ainda não somamos nenhuma receita.
        $total = 0;

        // Percorremos cada objeto Receita que veio do Repository.
        //
        // A cada repetição, $receita representa uma receita
        // individual da lista.
        foreach ($receitas as $receita) {

            // Pegamos o valor da receita através do getter.
            //
            // Como o Doctrine pode retornar o DECIMAL como string,
            // fazemos a conversão para float antes de somar.
            $total += (float) $receita->getValor();
        }

        // Depois que o foreach terminou,
        // retornamos o valor acumulado.
        return $total;
    }





}

