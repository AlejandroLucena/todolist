<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Task\Domain\Task;
use Modules\Task\Domain\Exception\NotFound;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\AlreadyExists;
use Modules\Task\Domain\Exception\AlreadyRelated;

class TaskAttacher
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(
        IdValueObject $id,
        IdValueObject $userId,
    ): void {

        $this->ensureExists($id);

        $this->taskRepository->attachUser($id, $userId);
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
