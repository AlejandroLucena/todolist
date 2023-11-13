<?php

namespace Tests\Unit\Task\Domain\Service;

use Mockery;
use Mockery\MockInterface;
use Tests\Unit\Task\TaskMother;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Task\Domain\Service\TaskUpdater;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;
use Tests\Unit\Shared\Domain\ValueObject\DateTimeValueObjectMother;

class TaskUpdaterTest extends TaskTestCase
{
    protected TaskUpdater $taskUpdater;
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function setUp(): void
    {
        unset($this->taskUpdater, $this->taskRepository, $this->taskFinder);

        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskFinder = new TaskFinder($this->taskRepository);
        $this->taskUpdater = new TaskUpdater(
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

        $this->taskUpdater->__invoke(
            $task->id(),
            $task->title(),
            $task->status(),
            $task->content(),
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

        $this->taskUpdater->__invoke(
            IdValueObjectMother::dummy(),
            TaskTitleMother::dummy(),
            TaskStatusMother::dummy(),
            TaskContentMother::dummy(),
            DateTimeValueObjectMother::dummy(),
        );
    }


    /**
     * @test
     * @return void
     */
    public function shouldUpdateTaskOkWithoutAllFields(): void
    {
        $task = TaskMother::dummy();

        $this->shouldFind($task);

        $this->shouldUpdateRepository();

        $this->expectNotToPerformAssertions();

        $this->taskUpdater->__invoke(
            IdValueObjectMother::dummy(),
            TaskTitleMother::dummy(),
            TaskStatusMother::dummy(),
            TaskContentMother::empty(),
            DateTimeValueObjectMother::dummy(),
        );
    }
}
