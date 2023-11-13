<?php

namespace Tests\Unit\Task\Domain\ValueObject;

use Modules\Task\Domain\ValueObject\TaskStatus;

class TaskStatusMother{

    public static function dummy(): TaskStatus
    {
        return TaskStatus::random();
    }

    public static function with(string $string): TaskStatus
    {
        return TaskStatus::fromString($string);
    }

    public static function empty(): TaskStatus
    {
        return self::with('');
    }
}