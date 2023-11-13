<?php

declare(strict_types=1);

namespace Modules\Shared\Infrastructure\Persistence\Provider;

use Illuminate\Support\ServiceProvider;
use Modules\Task\Domain\Contract\TaskRepository;

class PersistenceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Modules\Task\Domain\Contract\TaskRepository',
            'Modules\Task\Infrastructure\Persistence\Eloquent\EloquentTaskRepository'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            TaskRepository::class,
        ];
    }
}
