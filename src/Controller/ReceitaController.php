<?php

namespace App\Controller;

use App\Service\ReceitaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;


class ReceitaController extends AbstractController
{
    #[Route('/receita', name: 'receita_criar', methods: ['POST'])]
    public function criar(Request $request, ReceitaService $receitaService): Response
    {
        // pegar os dados do formulario
        $descricao = $request->request->get('descricao');
        $valor = $request->request->get('valor');
        $data = new \DateTime($request->request->get('data'));
        // chamar serviço de adicionar a nova receita
        $receita = $receitaService->adicionarReceita(
            $descricao,
            $valor,
            $data
        );
        return new Response('Dados recebidos com sucesso!');
    }
}

