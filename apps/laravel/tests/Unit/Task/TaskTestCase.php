<?php

namespace Tests\Unit\Task;

use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Modules\Task\Domain\Task;
use Mockery\MockInterface;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TaskTestCase extends TestCase
{
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function shouldSaveRepository(): void
    {
        $this->taskRepository
            ->shouldReceive('save')
            ->once();
    }

    public function shouldUpdateRepository(): void
    {
        $this->taskRepository
            ->shouldReceive('update')
            ->once();
    }

    public function shouldNotSaveRepository(): void
    {
        $this->taskRepository
            ->shouldReceive('save')
            ->andThrow(BadRequestException::class);
    }
    
    public function shouldDeleteRepository(): void
    {
        $this->taskRepository
            ->shouldReceive('delete')
            ->once();
    }
    
    public function shouldAttachRepository(): void
    {
        $this->taskRepository
            ->shouldReceive('attachUser')
            ->once();
    }
    
    public function shouldFind(Task $task): void
    {
        $this->taskRepository
            ->shouldReceive('find')
            ->andReturn($task->toPrimitives());
    }
    
    public function shouldNotFind(): void
    {
        $this->taskRepository
            ->shouldReceive('find')
            ->andThrow(NotFound::class);
    }
    
    public function shouldFindOrFail(Task $task): void
    {
        $this->taskRepository
            ->shouldReceive('findOrFail')
            ->with($task->id())
            ->andReturn($task->toPrimitives());
    }

    public function shouldNotFindOrFail(IdValueObject $id): void
    {
        $this->taskRepository
            ->shouldReceive('findOrFail')
            ->andThrow(NotFound::with($id));
    }

}