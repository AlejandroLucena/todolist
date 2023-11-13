<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;

final class TaskFinder
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
    ) {
    }

    public function findAll(): array
    {
        $task = $this->taskRepository->findAll();

        return $task;
    }

    public function find(IdValueObject $id): ?array
    {
        $task = $this->taskRepository->find($id);

        return $task;
    }

    public function findOrFail(IdValueObject $id): array
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            throw NotFound::with($id);
        }

        return $task;
    }
}
