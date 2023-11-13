<?php

namespace Modules\Shared\Services\Commands;

use Illuminate\Support\Facades\App;
use ReflectionClass;

class CommandBus
{
    public function dispatch($command)
    {
        // resolve handler
        $reflection = new ReflectionClass($command);
        $handlerName = str_replace('Command', 'CommandHandler', $reflection->getShortName());
        $handlerName = str_replace($reflection->getShortName(), $handlerName, $reflection->getName());
        $handler = App::make($handlerName);
        // invoke handler
        $handler($command);
    }
}
