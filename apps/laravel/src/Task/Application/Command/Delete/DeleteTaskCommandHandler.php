<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Delete;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Service\TaskRemover;

/**
 * Summary of DeleteTaskCommandHandler
 */
class DeleteTaskCommandHandler
{
    public function __construct(
        private readonly TaskRemover $taskRemover,
    ) {
    }

    /**
     * Summary of handle
     *
     * @return IdValueObject
     */
    public function __invoke(
        DeleteTaskCommand $command
    ): void {
        $this->taskRemover->__invoke(
            IdValueObject::from($command->id()),
        );
    }
}
