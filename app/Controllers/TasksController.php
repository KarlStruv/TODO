<?php

namespace App\Controllers;

use App\Models\Task;
use App\Repositories\CsvTasksRepository;
use App\Repositories\TasksRepository;
use Ramsey\Uuid\Uuid;


class TasksController{

    private TasksRepository $tasksRepository;

    public function __construct()
    {
        $this->tasksRepository = new CsvTasksRepository();
    }


    public function index()
    {
        $tasks = $this->tasksRepository->getAll();

        require_once 'app/Views/users/index.template.php';
    }

    public function create()
    {
        require_once 'app/Views/users/create.template.php';
    }

    public function store()
    {
        $task = new Task(
            Uuid::uuid4(),
            $_POST['title']
        );

        $this->tasksRepository->save($task);

        header("Location: /tasks");
    }
}