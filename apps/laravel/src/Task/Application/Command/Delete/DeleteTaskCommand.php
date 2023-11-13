<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Delete;

use Modules\Shared\Services\Commands\Command;

class DeleteTaskCommand extends Command
{
    public function __construct(
        private readonly int $id,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }
}
