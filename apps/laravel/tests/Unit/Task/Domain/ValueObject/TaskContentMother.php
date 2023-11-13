<?php

namespace Tests\Unit\Task\Domain\ValueObject;

use Modules\Task\Domain\ValueObject\TaskContent;
use Illuminate\Support\Str;

class TaskContentMother
{
    public static function dummy(): TaskContent
    {
        return TaskContent::from(Str::random(10));
    }

    public static function with(string $string): TaskContent
    {
        return TaskContent::from($string);
    }

    public static function empty(): TaskContent
    {
        return self::with('');
    }
}