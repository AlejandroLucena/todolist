<?php

declare(strict_types=1);

namespace Modules\Shared\Services\Queries;

use Illuminate\Support\Facades\App;
use ReflectionClass;

class QueryBus
{
    public function query(Query $query): ?array
    {
        // resolve handler
        $reflection = new ReflectionClass($query);
        $handlerName = str_replace('Query', 'QueryHandler', $reflection->getShortName());
        $handlerName = str_replace($reflection->getShortName(), $handlerName, $reflection->getName());
        $handler = App::make($handlerName);

        // invoke handler
        return $handler($query);
    }
}
