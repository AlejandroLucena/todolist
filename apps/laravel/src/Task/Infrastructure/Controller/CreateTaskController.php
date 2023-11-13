<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Controller;

use Illuminate\Http\Request;
use Modules\Shared\Infrastructure\Controller;
use Modules\Shared\Services\Commands\CommandBus;
use Modules\Task\Application\Command\Create\CreateTaskCommand;

/**
 * Summary of CreateTaskControlled
 */
class CreateTaskController extends Controller
{
    public function __construct(
        private readonly CommandBus $commandBus
    ) {
    }

    /**
     * Summary of __invoke
     */
    public function __invoke(Request $request): void
    {
        $this->commandBus->dispatch(new CreateTaskCommand(
            json_decode($request->getContent())->title,
            json_decode($request->getContent())->status,
            json_decode($request->getContent())->content
        ));
    }
}
