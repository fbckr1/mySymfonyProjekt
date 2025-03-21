<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\TodoService;

class TodoController extends AbstractController
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    #[Route('/todoapp', name: 'todoapp', methods: ['GET','POST'])]
    public function index(Request $request): Response
    {
        $todos = $this->todoService->getTodos();

        if ($request->isMethod('POST')) {
            $newTodo = $request->request->get('task');
            if ($newTodo !== null) {
                $success = $this->todoService->addTodo($newTodo);
                if ($success) {
                    $this->addFlash('success', 'To-Do hinzugefügt!');
                } else {
                    $this->addFlash('error', 'Fehler: Leere Eingabe!');
                }
            }
        }

        return $this->render('todo/todoapp.html.twig', [
            'todos' => $todos,
        ]);
    }

    #[Route('/deleteTodo', name: 'deleteTodo', methods: ['POST'])]
    public function removeTodo(Request $request): Response
    {
        $todoIndex = (int) $request->request->get('index');
        $success = $this->todoService->deleteTodo($todoIndex);
        if ($success) {
            $this->addFlash('success', 'To-Do entfernt!');
        } else {
            $this->addFlash('error', 'To-Do nicht gefunden!');
        }

        return $this->redirectToRoute('todoapp');
    }
}