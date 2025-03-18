<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    // #[Route('/hello', name: 'hello')]
    
    // public function index(): Response {
    //     return new Response('Hallo von Symfony!');
    // }

    #[route('/hello/{name}', name: 'hello_name', defaults: ['name' => 'Gast'])]
    #[route('/hallo/{name}', name: 'hallo_name', defaults: ['name' => 'Gast'])]  
    public function greet(string $name): Response {

        return $this->render('hello/greet.html.twig', [
            'name' => $name
        ]);
    }
}
