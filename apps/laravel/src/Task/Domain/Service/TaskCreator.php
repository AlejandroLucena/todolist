<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Task;
use Modules\Task\Domain\ValueObject\TaskContent;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\ValueObject\TaskTitle;

class TaskCreator
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(
        TaskTitle $title,
        TaskStatus $status,
        TaskContent $content,
        DateTimeValueObject $createdAt
    ): void {

        $task = new Task(
            null,
            $title,
            $status,
            $content,
            $createdAt
        );

        $this->taskRepository->save($task);
    }
}
