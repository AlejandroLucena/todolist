<?php

declare(strict_types=1);

namespace Modules\Task\Application\Query\Find\FindById;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Service\TaskFinder;

class FindTaskByIdQueryHandler
{
    public function __construct(
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(FindTaskByIdQuery $findTaskByIdQuery): ?array
    {
        $resource = $this->taskFinder->find(
            IdValueObject::from($findTaskByIdQuery->id())
        );

        return $resource;
    }
}
