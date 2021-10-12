<?php

namespace App\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;

interface TasksRepository
{
    public function getAll(): TasksCollection;
    public function save(Task $task): void;

}