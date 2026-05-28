<?php

class Task
{
    public static int $counter = 0;
    public int $id;
    public $communicated = false;
    public function __construct(protected string $taskName, protected string $student)
    {
        $this->id = ++self::$counter;
    }
    public function __toString(): string
    {
        return "$this->taskName hecha por $this->student";
    }
    public function alert(): string
    {
        return "Se ha entregado una nueva actividad : $this";
    }
}

class Instructor
{
    public function __construct(protected string $name) {}
    public function getNotified(Task $evento)
    {
        echo "Hola $this->name \n" . $evento->alert() . "\n";
    }
}

class MoodleCourse
{
    protected array $tasks = [];
    protected array $instructors = [];

    public function addInstructor(string $name)
    {
        $this->instructors[] = new Instructor($name);
    }
    public function deliverTask(string $taskName, string $student)
    {
        $newTask = new Task($taskName, $student);
        $this->tasks[] = $newTask;
        $this->notifyInstructors();
    }
    public function notifyInstructors()
    {
        $tasks = $this->getTasks();
        if (empty($tasks) || empty($this->instructors)) {
            echo "Warning: No existen tareas o instructores para comunicar entregas!\n";
        } else {
            foreach ($tasks as $task) {
                foreach ($this->instructors as $instructor) {
                    $instructor->getNotified($task);
                }
                $this->changeTaskStatus($task->id);
            }
        }
    }
    public function getTasks(): array
    {
        return array_filter($this->tasks, fn($t) => $t->communicated === false);
    }
    public function changeTaskStatus(int $id)
    {
        $task = array_find($this->tasks, fn($t) =>
        $t->id === $id);
        $task->communicated = true;
    }
}
