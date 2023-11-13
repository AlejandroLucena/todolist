<?php

namespace Tests\Unit\Task\Domain\Service;

use Mockery;
use Mockery\MockInterface;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Task\Domain\Service\TaskRemover;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Tests\Unit\Task\TaskMother;

class TaskRemoverTest extends TaskTestCase
{
    /**
     * Summary of taskRemover
     * @var TaskRemover
     */
    protected TaskRemover $taskRemover;
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function setUp(): void
    {
        unset($this->taskRemover, $this->taskRepository, $this->taskFinder);

        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskFinder = new TaskFinder($this->taskRepository);
        $this->taskRemover = new TaskRemover(
            $this->taskRepository,
            $this->taskFinder
        );

        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function shouldDeleteTaskOk(): void
    {
        $task = TaskMother::dummy();

        $this->shouldFind($task);

        $this->shouldDeleteRepository();

        $this->expectNotToPerformAssertions();

        $this->taskRemover->__invoke(
            $task->id()
        );
    }

    /**
     * @test
     * @return void
     */
    public function shouldDeleteTaskKoNotFound(): void
    {
        $task = TaskMother::dummy();

        $this->shouldNotFind();

        $this->expectException(NotFound::class);

        $this->taskRemover->__invoke(
            $task->id()
        );
    }
}
