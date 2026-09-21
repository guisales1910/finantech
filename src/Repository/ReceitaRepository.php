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

    public function listarReceitasUltimos30Dias(): array
    {
        // Cria um QueryBuilder e define "receita" como apelido
        // para a entidade Receita dentro da consulta.
        $queryBuilder = $this->createQueryBuilder('receita');

        // Define a condição da consulta:
        // queremos somente receitas cuja data seja
        // maior ou igual à data informada em :data.
        $queryBuilder->where('receita.data >= :data');

        // Calcula a data de 30 dias atrás a partir de hoje.
        $data = new \DateTimeImmutable('-30 days');

        // Substitui o parâmetro :data da consulta
        // pelo valor que calculamos acima.
        $queryBuilder->setParameter('data', $data);

        // Transforma o QueryBuilder em uma Query executável
        // e executa a consulta.
        //
        // getResult() retorna todas as receitas encontradas
        // em formato de array de objetos Receita.
        return $queryBuilder->getQuery()->getResult();
    }

    public function buscarPorId(int $id): ?Receita
    {
        // Procura uma Receita pelo ID.
        //
        // Se encontrar, retorna um objeto Receita.
        // Se não encontrar, retorna null.
        return $this->find($id);
    }

    public function buscarTodas(): array
    {
        return $this->findAll();
    }

}
