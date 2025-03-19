<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
    #[Route('/todoapp', name: 'todoapp', methods: ['POST'])]   
    public function createTodo(Request $request, SessionInterface $session): Response
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

    #[Route('/deleteTodo', name: 'deleteTodo', methods: ['POST'])]
    public function removeTodo(Request $request, SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) {
            $todoIndex = $request->request->get('index');
            if ($session->has('todos')) {
                $todos = $session->get('todos');
                if (isset($todos[$todoIndex])) {
                    unset($todos[$todoIndex]);
                    $session->set('todos', array_values($todos));
                }
            }
        }
        return $this->redirectToRoute('todoapp');
    }
}