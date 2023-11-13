<?php

namespace Modules\Shared\Infrastructure\Bus\Command;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class CommandBus
{
    public function handle($commands)
    {
        if (! is_array($commands)) {
            $commands = [$commands];
        }

        $exception = null;
        try {
            DB::transaction(function () use ($commands) {
                $exception = null;
                foreach ($commands as $command) {
                    try {
                        if (is_null($exception)) {
                            // resolve handler
                            $reflection = new ReflectionClass($command);
                            $handlerName = str_replace('Command', 'CommandHandler', $reflection->getShortName());
                            $handlerName = str_replace($reflection->getShortName(), $handlerName, $reflection->getName());
                            $handler = App::make($handlerName);
                            // invoke handler
                            $handler($command);
                        }
                    } catch (Exception $e) {
                        $exception = $e;
                    }
                }
                if ($exception) {
                    throw $exception;
                }
            });
        } catch (\Exception $commandsException) {
            $exception = $commandsException;
        }

        // finally if there was an exception
        // let's throw it to previous layer
        if ($exception) {
            throw $exception;
        }
    }
}
