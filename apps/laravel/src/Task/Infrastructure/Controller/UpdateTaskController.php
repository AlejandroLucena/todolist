<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Illuminate\Http\Request;
use Modules\Shared\Infrastructure\Controller;
use Modules\Shared\Services\Commands\CommandBus;
use Modules\Task\Application\Command\Update\UpdateTaskCommand;

class UpdateTaskController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    public function __invoke(Request $request, int $id)
    {
        $title = $request->input('title');
        $status = $request->input('status');
        $content = $request->input('content') ? $request->input('content') : '';

        $this->commandBus->dispatch(new UpdateTaskCommand(
            $id,
            $title,
            $status,
            $content
        ));
    }
}
