<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\UpdateStatus;

use Modules\Shared\Services\Commands\Command;

/**
 * Summary of UpdateStatusCommand
 */
class UpdateStatusCommand extends Command
{
    public function __construct(
        private readonly int $id,
        private readonly string $status,
    ) {
    }

    /**
     * Summary of id
     */
    public function id(): int
    {
        return $this->id;
    }

    public function status(): string
    {
        return $this->status;
    }
}
