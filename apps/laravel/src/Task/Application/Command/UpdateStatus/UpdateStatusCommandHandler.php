<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\UpdateStatus;

use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\Service\TaskStatusUpdater;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Shared\Domain\ValueObject\DateTimeValueObject;

/**
 * Summary of UpdateStatusCommandHandler
 */
class UpdateStatusCommandHandler
{
    public function __construct(
        private readonly TaskStatusUpdater $taskStatusUpdater,
    ) {
    }

    /**
     * Summary of handle
     */
    public function __invoke(
        UpdateStatusCommand $command
    ): void {

        $this->taskStatusUpdater->__invoke(
            IdValueObject::from($command->id()),
            TaskStatus::from($command->status()),
            DateTimeValueObject::now(),
        );
    }
}
