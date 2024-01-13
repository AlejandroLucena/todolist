<?php

declare(strict_types=1);

namespace Modules\Task\Infrastructure\Persistence\Eloquent;

use Exception;
use Illuminate\Support\Facades\Cache;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Model\Task as EloquentTaskModel;
use Modules\Task\Domain\Resource\TaskResource;
use Modules\Task\Domain\Task;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


final class EloquentTaskRepository implements TaskRepository
{
    /**
     * Summary of __construct
     * @param \Modules\Task\Domain\Model\Task $eloquentTaskModel
     */
    public function __construct(
        private readonly EloquentTaskModel $eloquentTaskModel
    ) {
    }

    public function save(Task $task): array
    {
        try {
            Cache::forget('tasks_all');

            $eloquentTask = $this->eloquentTaskModel;
            $eloquentTask->title = $task->title()->value();
            $eloquentTask->status = $task->status()->value();
            $eloquentTask->content = $task->content()->value();
            $eloquentTask->created_at = $task->createdAt()->toIso8601Format();

            $eloquentTask->save();

            Cache::rememberForever('tasks_all', function () {
                return $this->eloquentTaskModel->all();
            });

            return TaskResource::make($eloquentTask)->resolve();
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function update(Task $task): void
    {
        $id = $task->id()->value();
        try {
            Cache::forget('tasks_all');
            Cache::forget('task_'.$id);

            $eloquentTask = $this->eloquentTaskModel->find($task->id()->value());
            $eloquentTask->title = $task->title()->value();
            $eloquentTask->status = $task->status()->value();
            $eloquentTask->content = $task->content()->value();
            $eloquentTask->updated_at = $task->updatedAt()->toIso8601Format();

            $eloquentTask->save();
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }


    public function find(IdValueObject $id): ?array
    {
        $id = $id->value();
        try {
            if (! Cache::has('task_'.$id)) {
                Cache::rememberForever('task_'.$id, function () use ($id) {
                    return $this->eloquentTaskModel->find($id);
                });
            }
            $task = Cache::get('task_'.$id);

            if (! $task) {
                return [];
            }

            return TaskResource::make($task)->resolve();
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function findAll(): array
    {
        try {
            if (! Cache::has('tasks_all')) {
                Cache::rememberForever('tasks_all', function () {
                    return $this->eloquentTaskModel->get();
                });
            }
            $tasks = Cache::get('tasks_all');

            return TaskResource::collection($tasks)->resolve();
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function delete(IdValueObject $id): bool
    {
        try {
            Cache::forget('tasks_all');
            Cache::forget('task_'.$id->value());

            $eloquentModel = $this->eloquentTaskModel->find($id->value());

            $eloquentModel->users()->detach();

            return $eloquentModel->delete();
        } catch (Exception $e) {
            Cache::rememberForever('tasks_all', function () {
                return $this->eloquentTaskModel->all();
            });
            throw new BadRequestException($e->getMessage());
        }
    }

    public function attachUser(IdValueObject $id, IdValueObject $userId): void
    {
        $id = $id->value();
        $userId = $userId->value();

        Cache::forget('tasks_all');
        Cache::forget('task_'.$id);
        
        $eloquentModel = $this->eloquentTaskModel->find($id);
        
        try{
            if(!$eloquentModel->users->contains($userId)) {
                $eloquentModel->users()->attach($userId);
            }
        } catch (Exception $e){
            throw new BadRequestException($e->getMessage());    
        }
    }
}
