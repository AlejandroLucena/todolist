<?php

declare(strict_types=1);

namespace Modules\Task\Domain;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\ValueObject\TaskContent;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\ValueObject\TaskTitle;

class Task
{
    private ?DateTimeValueObject $deletedAt;

    public function __construct(
        private ?IdValueObject $id,
        private TaskTitle $title,
        private TaskStatus $status,
        private ?TaskContent $content,
        private DateTimeValueObject $createdAt,
        private ?DateTimeValueObject $updatedAt = null,
    ) {
        $this->deletedAt = null;
    }

    public function id(): ?IdValueObject
    {
        return $this->id ? $this->id : null;
    }

    public function title(): TaskTitle
    {
        return $this->title;
    }

    public function status(): TaskStatus
    {
        return $this->status;
    }

    public function content(): ?TaskContent
    {
        return $this->content ? $this->content : '';
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeValueObject
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?DateTimeValueObject
    {
        return $this->deletedAt;
    }

    public static function create(
        TaskTitle $title,
        TaskStatus $status,
        TaskContent $content,
        DateTimeValueObject $createdAt,
    ): Task {
        return new self(
            null,
            $title,
            $status,
            $content,
            $createdAt
        );
    }

    public function update(
        IdValueObject $id,
        TaskTitle $title,
        TaskStatus $status,
        TaskContent $content,
        DateTimeValueObject $updateAt,
    ): self {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->content = $content;
        $this->updatedAt = $updateAt;

        return $this;
    }

    /**
     * Summary of delete
     */
    public function delete(): void
    {
        $this->deletedAt = DateTimeValueObject::now();
    }

    public static function fromPrimitives(array $primitives): self
    {
        return new self(
            IdValueObject::from($primitives['id']),
            TaskTitle::from($primitives['title']),
            TaskStatus::from($primitives['status']),
            TaskContent::from($primitives['content']),
            DateTimeValueObject::createFromString($primitives['created_at']),
            DateTimeValueObject::createFromString($primitives['updated_at'])
        );
    }

    public static function fromValueObjects(array $valueObjects): self
    {
        return new self(
            IdValueObject::from($valueObjects['id']->value()),
            TaskTitle::from($valueObjects['title']->value()),
            TaskStatus::from($valueObjects['status']->value()),
            TaskContent::from($valueObjects['content']->value()),
            DateTimeValueObject::createFromString($valueObjects['created_at']->toIso8601Format()),
            DateTimeValueObject::createFromString($valueObjects['updated_at']->toIso8601Format())
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id()->value(),
            'title' => $this->title()->value(),
            'status' => $this->status()->value(),
            'content' => $this->content()->value(),
            'created_at' => $this->createdAt()->toIso8601Format(),
            'updated_at' => $this->updatedAt()->toIso8601Format(),
        ];
    }
}
