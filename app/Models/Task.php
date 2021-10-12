<?php

namespace App\Models;

class Task
{
    private string $id;
    private string $title;
    private string $status;

    public const STATUS_CREATED = 'created';
    public const STATUS_COMPLETED = 'completed';

    private const STATUSES = [
        self::STATUS_CREATED,
        self::STATUS_COMPLETED
    ];

    public function __construct(string $id, string $title, ?string $status = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->setStatus($status ?? Task::STATUS_CREATED);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        if (! in_array($status, self::STATUSES)){
            return;
        }

        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'status' => $this->getStatus()
        ];
    }

}
