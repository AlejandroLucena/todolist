<?php

namespace Tests\Unit\Task\Domain\ValueObject;

use Modules\Task\Domain\ValueObject\TaskTitle;
use Illuminate\Support\Str;

class TaskTitleMother{

    public static function dummy(): TaskTitle
    {
        return TaskTitle::from(Str::random(10));
    }

    public static function with(string $string): TaskTitle
    {
        return TaskTitle::from($string);
    }

    public static function empty(): TaskTitle
    {
        return self::with('');
    }
}