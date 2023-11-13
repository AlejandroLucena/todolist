<?php

namespace Tests\Unit\Task\Domain\Service;

use Mockery;
use Mockery\MockInterface;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskFinder;
use Modules\Task\Domain\Service\TaskCreator;
use Modules\Task\Domain\Contract\TaskRepository;
use Modules\Shared\Domain\Exception\InvalidValueException;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Shared\Domain\ValueObject\DateTimeValueObjectMother;

class TaskCreatorTest extends TaskTestCase
{
    protected TaskCreator $taskCreator;
    protected TaskRepository|MockInterface $taskRepository;
    protected TaskFinder|MockInterface $taskFinder;

    public function setUp(): void
    {
        unset($this->taskCreator, $this->taskRepository, $this->taskFinder);

        $this->taskRepository = Mockery::mock(TaskRepository::class);
        $this->taskFinder = new TaskFinder($this->taskRepository);
        $this->taskCreator = new TaskCreator(
            $this->taskRepository,
            $this->taskFinder
        );

        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function shouldCreateTaskOk(): void
    {
        $this->shouldSaveRepository();

        $this->expectNotToPerformAssertions();

        $this->taskCreator->__invoke(
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
    public function shouldCreateTaskKoWithoutTitle(): void
    {
        $this->expectException(InvalidValueException::class);

        $this->taskCreator->__invoke(
            TaskTitleMother::empty(),
            TaskStatusMother::empty(),
            TaskContentMother::dummy(),
            DateTimeValueObjectMother::dummy(),
        );
    }

}
