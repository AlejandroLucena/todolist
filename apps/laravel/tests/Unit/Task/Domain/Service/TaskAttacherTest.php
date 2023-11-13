<?php

namespace Tests\Unit\Task\Domain\Service;

use Mockery;
use Mockery\MockInterface;
use Tests\Unit\Task\TaskMother;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Task\Domain\Service\TaskAttacher;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Task\Domain\Exception\NotFound;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;

class TaskAttacherTest extends TaskTestCase
{
    protected TaskAttacher $taskAttacher;
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function setUp(): void
    {
        unset($this->taskAttacher, $this->taskRepository, $this->taskFinder);

        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskFinder = new TaskFinder($this->taskRepository);
        $this->taskAttacher = new TaskAttacher(
            $this->taskRepository,
            $this->taskFinder
        );

        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function shouldAttachUserOk(): void
    {
        $task = TaskMother::dummy();

        $this->shouldFind($task);

        $this->shouldAttachRepository();

        $this->expectNotToPerformAssertions();

        $this->taskAttacher->__invoke(
            $task->id(),
            IdValueObjectMother::dummy()
        );
    }

    /**
     * @test
     * @return void
     */
    public function shouldAttachUserKo(): void
    {
        $this->shouldNotFind();

        $this->expectException(NotFound::class);

        $this->taskAttacher->__invoke(
            IdValueObjectMother::dummy(),
            IdValueObjectMother::dummy()
        );
    }
}
