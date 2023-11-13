<?php

namespace Tests\Unit\Task;

use Modules\Task\Domain\Task;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Shared\Domain\ValueObject\DateTimeValueObjectMother;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;

class TaskMother{

    public static function dummy(): Task
    {
        $values = [
            'id' => IdValueObjectMother::dummy(),
            'title' => TaskTitleMother::dummy(),
            'status' => TaskStatusMother::dummy(),
            'content' => TaskContentMother::dummy(),
            'created_at' => DateTimeValueObjectMother::dummy(),
            'updated_at' => DateTimeValueObjectMother::dummy(),
        ];

        $task = Task::create(
            $values['title'],
            $values['status'],
            TaskContentMother::with('Updated'),
            $values['created_at'],
        );

        $task->update(
            $values['id'],
            $values['title'],
            $values['status'],
            TaskContentMother::with('Updated'),
            $values['updated_at'],
        );

        return $task;
    }

    public static function withTitle(string $value): Task
    {
        $title = TaskTitleMother::with($value);

        $values = [
            'id' => IdValueObjectMother::dummy(),
            'title' => TaskTitleMother::dummy(),
            'status' => TaskStatusMother::dummy(),
            'content' => TaskContentMother::dummy(),
            'created_at' => DateTimeValueObjectMother::dummy(),
            'updated_at' => DateTimeValueObjectMother::dummy(),
        ];

        $task = Task::create(
            $values['title'],
            $values['status'],
            $values['content'],
            $values['created_at'],
        );

        $task->update(
            $values['id'],
            $title,
            $values['status'],
            TaskContentMother::with('Updated'),
            $values['created_at'],
        );
        return $task;
    }
    
    public static function emptyTitle(): Task
    {
        return self::withTitle('');
    }
}