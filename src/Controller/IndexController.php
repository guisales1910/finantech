<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}

