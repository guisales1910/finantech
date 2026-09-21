<?php

namespace App\Controller;

use App\Service\ReceitaService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReceitaController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('painel.html.twig');
    }

    #[Route('/receita', name: 'receita_criar', methods: ['POST'])]
    public function criar(
        Request $request,
        ReceitaService $receitaService
    ): Response {

        // Pega os dados enviados pelo formulário
        $descricao = $request->request->get('descricao');
        $valor = $request->request->get('valor');
        $data = new \DateTime($request->request->get('data'));

        // Pede ao Service para criar e salvar a receita
        $receitaService->adicionarReceita(
            $descricao,
            $valor,
            $data
        );
        return $this->redirectToRoute('receitas');
    }

    #[Route('/receitas/lista', name: 'receitas', methods: ['GET'])]
    public function listarReceitas(
        ReceitaService $receitaService
    ): Response {

        // Pede ao Service as receitas dos últimos 30 dias
        $receitas = $receitaService->ReceitasUltimos30dias();

        // Envia as receitas para o Twig
        return $this->render('painel.html.twig', [
            'receitas' => $receitas,
        ]);
    }


}
