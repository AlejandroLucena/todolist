<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Service;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;

class TaskRemover
{
    public function __construct(
        private readonly TaskRepository $repository,
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(
        IdValueObject $id,
    ): void {
        $this->ensureTaskExists($id);

        $this->repository->delete($id);
    }

    public function ensureTaskExists(IdValueObject $id): void
    {
        $response = $this->repository->find($id);

        if (! $response) {
            throw NotFound::with($id);
        }
    }
}
