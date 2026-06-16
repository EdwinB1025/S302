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

interface Observer
{
    public function getNotified(Task $task);
}

interface Subject
{
    public function addInstructor(Observer $observer);
    public function notify(Task $task);
}
class Instructor implements Observer
{
    public function __construct(protected string $name) {}
    public function getNotified(Task $evento)
    {
        echo "Hola $this->name \n" . $evento->alert() . "\n";
    }
}

class MoodleCourse implements Subject
{
    protected array $tasks = [];
    protected array $instructors = [];

    public function addInstructor(Observer $name)
    {
        $this->instructors[] = $name;
    }
    public function deliverTask(string $taskName, string $student)
    {
        $newTask = new Task($taskName, $student);
        $this->tasks[] = $newTask;
        $this->notify($newTask);
    }
    public function notify(Task $task)
    {
        if (empty($this->tasks) || empty($this->instructors)) {
            echo "Warning: No existen tareas o instructores para comunicar entregas!\n";
        } else {

            foreach ($this->instructors as $instructor) {
                $instructor->getNotified($task);
            }
            $this->changeTaskStatus($task->id);
        }
    }
    private function changeTaskStatus(int $id)
    {
        $task = array_find($this->tasks, fn($t) =>
        $t->id === $id);
        $task->communicated = true;
    }
}
