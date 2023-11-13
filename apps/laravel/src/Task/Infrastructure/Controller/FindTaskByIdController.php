<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Modules\Shared\Services\Queries\QueryBus;
use Modules\Task\Application\Query\Find\FindById\FindTaskByIdQuery;
use Modules\Shared\Infrastructure\Controller;

final class FindTaskByIdController extends Controller
{
    public function __construct(
        private readonly QueryBus $queryBus
    ) {
    }

    public function __invoke(int $id): ?array
    {
        $resource = $this->queryBus->query(new FindTaskByIdQuery($id));

        return $resource;
    }
}
