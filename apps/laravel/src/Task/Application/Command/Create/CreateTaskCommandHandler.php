<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Create;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Modules\Task\Domain\Service\TaskCreator;
use Modules\Task\Domain\ValueObject\TaskContent;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Modules\Task\Domain\ValueObject\TaskTitle;

/**
 * Summary of CreateTaskCommandHandler
 */
class CreateTaskCommandHandler
{
    public function __construct(
        private readonly TaskCreator $taskCreator
    ) {
    }

    /**
     * Summary of handle
     */
    public function __invoke(
        CreateTaskCommand $command
    ): void {
        $this->taskCreator->__invoke(
            TaskTitle::from($command->title()),
            TaskStatus::from($command?->status()),
            TaskContent::from($command?->content()),
            DateTimeValueObject::now()
        );
    }
}
