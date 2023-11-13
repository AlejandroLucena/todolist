<?php

declare(strict_types=1);

namespace Modules\Task\Application\Query\Find\FindById;

use Modules\Shared\Services\Queries\Query;

class FindTaskByIdQuery extends Query
{
    public function __construct(
        private readonly int $id
    ) {
    }

    /**
     * Summary of id
     */
    public function id(): int
    {
        return $this->id;
    }
}
