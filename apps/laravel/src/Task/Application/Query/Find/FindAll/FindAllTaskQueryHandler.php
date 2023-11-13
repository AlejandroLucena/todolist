<?php

declare(strict_types=1);

namespace Modules\Task\Application\Query\Find\FindAll;

use Modules\Task\Domain\Service\TaskFinder;

class FindAllTaskQueryHandler
{
    public function __construct(
        private readonly TaskFinder $taskFinder
    ) {
    }

    public function __invoke(): ?array
    {
        $resource = $this->taskFinder->findAll();

        return $resource;
    }
}
