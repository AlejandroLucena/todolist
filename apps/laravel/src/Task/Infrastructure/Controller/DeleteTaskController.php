<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Modules\Shared\Infrastructure\Controller;
use Modules\Shared\Services\Commands\CommandBus;
use Modules\Task\Application\Command\Delete\DeleteTaskCommand;

class DeleteTaskController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function __invoke(int $id)
    {
        $this->commandBus->dispatch(new DeleteTaskCommand(
            $id
        ));
    }
}
