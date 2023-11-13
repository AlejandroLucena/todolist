<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Modules\Shared\Infrastructure\Controller;
use Modules\Shared\Services\Commands\CommandBus;
use Modules\Task\Application\Command\AttachUser\AttachUserToTaskCommand;

class AttachUserToTaskController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function __invoke(int $id, int $userId)
    {
        $this->commandBus->dispatch(new AttachUserToTaskCommand(
            $id,
            $userId
        ));

    }
}
