<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\Service\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Infrastructure\Persistence\Eloquent\EloquentTaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TaskRepository::class, EloquentTaskRepository::class);
    }
}
