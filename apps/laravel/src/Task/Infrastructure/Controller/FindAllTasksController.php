<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Modules\Shared\Infrastructure\Controller;
use Modules\Shared\Services\Queries\QueryBus;
use Modules\Task\Application\Query\Find\FindAll\FindAllTaskQuery;

final class FindAllTasksController extends Controller
{
    public function __construct(
        private readonly QueryBus $queryBus
    ) {
    }

    public function __invoke(): array
    {
        $resource = $this->queryBus->query(new FindAllTaskQuery());
        return $resource;
    }
}