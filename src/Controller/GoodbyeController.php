<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GoodbyeController extends AbstractController
{
    #[Route('/goodbye/{name}', name: 'goodbye_name')]
    public function goodbye(string $name): Response
    {
        return $this->render('goodbye/farewell.html.twig', [
            'name' => $name
        ]);
    }
}