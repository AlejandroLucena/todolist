<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Modules\Task\Domain\Task;
use Modules\Task\Domain\ValueObject\TaskStatus;

class TaskStatusUpdater
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(
        IdValueObject $id,
        TaskStatus $status,
        ?DateTimeValueObject $updatedAt
    ): void {

        $task = $this->ensureExists($id); //find

        $task->update(
            $id,
            $task->title(),
            $status,
            $task->content(),
            $updatedAt
        );

        $this->taskRepository->update($task);
    }

    private function ensureExists(IdValueObject $id): ?Task
    {
        $response = $this->taskFinder->find($id);
        if (! $response) {
            throw NotFound::with($id);
        }

        return Task::fromPrimitives($response);
    }
}
