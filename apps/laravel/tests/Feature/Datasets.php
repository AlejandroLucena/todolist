<?php

use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;

dataset('validValues',[
    [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::dummy()->value(),
    ],
    [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::empty()->value(),
    ]
]);