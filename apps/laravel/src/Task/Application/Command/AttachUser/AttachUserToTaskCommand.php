<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\AttachUser;

/**
 * Summary of UpdateTaskCommand
 */
class AttachUserToTaskCommand
{
    public function __construct(
        private readonly int $id,
        private readonly int $UserId,
    ) {
    }

    /**
     * Summary of id
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Summary of UserId
     */
    public function UserId(): int
    {
        return $this->UserId;
    }
}
