<?php

namespace App\Service;

class TodoService
{
    private array $todos = ["Symfony lernen","Twig lernen"];

    /**
     * Gibt die Liste aller To-Dos zurück.
     *
     * @return array Die Liste der To-Dos
     */
    public function getTodos(): array
    {
        return $this->todos;
    }

    /**
     * Fügt ein neues To-Do zur Liste hinzu, wenn es nicht leer ist.
     *
     * @param string $task Der Text des neuen To-Dos
     * @return bool True, wenn das To-Do hinzugefügt wurde, false, wenn es leer ist
     */
    public function addTodo(string $task): bool
    {
        $task = trim($task);
        if (strlen($task) === 0) {
            return false;
        }

        $this->todos[] = $task;
        return true;
    }

    /**
     * Entfernt ein To-Do anhand seines Index aus der Liste.
     *
     * @param int $index Der Index des zu entfernenden To-Dos
     * @return bool True, wenn das To-Do entfernt wurde, false, wenn der Index nicht existiert
     */
    public function deleteTodo(int $index): bool
    {
        if (!isset($this->todos[$index])) {
            return false;
        }

        unset($this->todos[$index]);
        $this->todos = array_values($this->todos);
        return true;
    }
}