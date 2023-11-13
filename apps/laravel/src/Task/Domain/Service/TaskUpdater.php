<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Modules\Task\Domain\Task;
use Modules\Task\Domain\ValueObject\TaskContent;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\ValueObject\TaskTitle;

class TaskUpdater
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(
        IdValueObject $id,
        ?TaskTitle $title,
        ?TaskStatus $status,
        ?TaskContent $content,
        ?DateTimeValueObject $updatedAt
    ): void {

        $task = $this->ensureExists($id); //find

        $task->update(
            $id,
            $title ? $title : $task->title(),
            $status ? $status : $task->status(),
            $content ? $content : $task->content(),
            $updatedAt
        );

        $this->taskRepository->update($task);
    }

    private function ensureExists(IdValueObject $id)
    {
        $resource = $this->taskFinder->find($id);
        if (! $resource) {
            throw NotFound::with($id);
        }

        return Task::fromPrimitives($resource);
    }
}
