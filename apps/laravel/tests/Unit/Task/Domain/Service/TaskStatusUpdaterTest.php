<?php

namespace Tests\Unit\Task\Domain\Service;

use Mockery;
use Mockery\MockInterface;
use Tests\Unit\Task\TaskMother;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Exception\NotFound;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Service\TaskStatusUpdater;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;
use Tests\Unit\Shared\Domain\ValueObject\DateTimeValueObjectMother;

class TaskStatusUpdaterTest extends TaskTestCase
{
    protected TaskStatusUpdater $taskStatusUpdater;
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function setUp(): void
    {
        unset($this->taskStatusUpdater, $this->taskRepository, $this->taskFinder);

        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskFinder = new TaskFinder($this->taskRepository);
        $this->taskStatusUpdater = new TaskStatusUpdater(
            $this->taskRepository,
            $this->taskFinder
        );

        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function shouldUpdateTaskOk(): void
    {
        $task = TaskMother::dummy();

        $this->shouldFind($task);
        $this->shouldUpdateRepository();

        $this->expectNotToPerformAssertions();

        $this->taskStatusUpdater->__invoke(
            $task->id(),
            TaskStatusMother::dummy(),
            DateTimeValueObjectMother::dummy(),
        );
    }

    /**
     * @test
     * @return void
     */
    public function shouldUpdateTaskKo(): void
    {
        $this->shouldNotFind();

        $this->expectException(NotFound::class);

        $this->taskStatusUpdater->__invoke(
            IdValueObjectMother::dummy(),
            TaskStatusMother::dummy(),
            DateTimeValueObjectMother::dummy(),
        );
    }
}