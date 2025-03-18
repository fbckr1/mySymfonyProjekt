<?php

namespace App\Controller;

    use symfony\Component\HttpFoundation\Response;
    use symfony\Component\Routing\Annotation\Route;
    use symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class TodoController extends AbstractController
    {
        
        #[Route('/todoapp', name: 'todoapp')]   

        public function index(): Response
        {
            $todos = [];
            return $this->render('todo/todoapp.html.twig', [
                'todos' => $todos,
            ]);
            
        }
    }