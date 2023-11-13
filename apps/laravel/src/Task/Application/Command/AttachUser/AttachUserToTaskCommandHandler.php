<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\AttachUser;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Service\TaskAttacher;

/**
 * Summary of AttachUserToTaskCommandHandler
 */
class AttachUserToTaskCommandHandler
{
    public function __construct(
        private readonly TaskAttacher $taskAttacher,
    ) {
    }

    /**
     * Summary of handle
     */
    public function __invoke(
        AttachUserToTaskCommand $command
    ): void {
        $this->taskAttacher->__invoke(
            IdValueObject::from($command->id()),
            IdValueObject::from($command->userId())
        );
    }
}
