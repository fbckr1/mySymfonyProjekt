<?php

namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class TodoController extends AbstractController
    {
        
        #[Route('/todoapp', name: 'todoapp')]   

        public function index(Request $request, SessionInterface $session): Response
        {
            if(!$session->has('todos')) {
                $session->set('todos', []);
            }
            $todos = $session->get('todos');

            if($request->isMethod('POST')) {
                $newTodo = $request->request->get('todos');
                if($newTodo) {
                    $todos[] = $newTodo;
                    $session->set('todos', $todos);
                }
            }
            
            return $this->render('todo/todoapp.html.twig', [
                'todos' => $todos,
            ]);
            
        }
    }