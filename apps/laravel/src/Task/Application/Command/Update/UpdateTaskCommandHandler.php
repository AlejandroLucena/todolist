<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Update;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Service\TaskUpdater;
use Modules\Task\Domain\ValueObject\TaskContent;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\ValueObject\TaskTitle;

/**
 * Summary of UpdateTaskCommandHandler
 */
class UpdateTaskCommandHandler
{
    public function __construct(
        private readonly TaskUpdater $taskUpdater,
    ) {
    }

    /**
     * Summary of handle
     */
    public function __invoke(
        UpdateTaskCommand $command
    ): void {

        $this->taskUpdater->__invoke(
            $command->id() ? IdValueObject::from($command->id()) : null,
            $command->title() ? TaskTitle::from($command->title()) : null,
            $command->status() ? TaskStatus::from($command->status()) : null,
            $command->content() ? TaskContent::from($command->content()) : null,
            DateTimeValueObject::now(),
        );
    }
}
