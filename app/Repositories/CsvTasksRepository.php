<?php

namespace App\Repositories;

use App\Models\Collections\TasksCollection;
use App\Models\Task;
use League\Csv\Reader;
use League\Csv\Writer;
use PDO;


class CsvTasksRepository implements TasksRepository
{
    private Reader $reader;

    public function __construct()
    {
        $this->reader = Reader::createFromPath(base_path() . '/storage/tasks.csv');
        $this->reader->setDelimiter(',');
    }

    public function getAll(): TasksCollection
    {
        $collection = new TasksCollection();

        foreach ($this->reader->getRecords() as $record){
            $collection->add(new Task(
                $record[0],
                $record[1],
                $record[2]
            ));
        }

        return $collection;
    }

    public function save(Task $task): void
    {
        $writer = Writer::createFromPath(base_path() . '/storage/tasks.csv', 'a+');
        $this->reader->setDelimiter(',');
        $writer->insertOne($task->toArray());
    }
}