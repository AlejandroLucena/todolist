<?php

declare(strict_types=1);

use Mockery\MockInterface;
use Modules\Task\Application\Command\Create\CreateTaskCommand;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskCreator;
use Modules\Task\Application\Command\Create\CreateTaskCommandHandler;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;

class CreateTaskCommandHandlerTest extends TaskTestCase
{
    /**
     * Summary of taskCreator
     * @var CreateTaskCommandHandler
     */
    protected CreateTaskCommand|MockInterface $createTaskCommand;
    protected CreateTaskCommandHandler $createTaskCommandHandler;
    protected TaskCreator|MockInterface $taskCreator;

    public function setUp(): void
    {
        $this->taskCreator = $this->getMockBuilder(
            TaskCreator::class,
        )->disableOriginalConstructor()->getMock();

        parent::setUp();
    }

    /**
     * @test
     * @dataProvider validValues
     * @return void
     */
    public function testHandlerOk($validValues): void
    {
        $payload = json_decode($validValues, true, 512, JSON_THROW_ON_ERROR);

        $this->createTaskCommandHandler = new CreateTaskCommandHandler($this->taskCreator);

        $this->expectNotToPerformAssertions();

        $this->createTaskCommandHandler->__invoke(new CreateTaskCommand(
            ...$payload
        ));
    }


    public static function validValues()
    {
        return [
            [
                json_encode([
                    'title' => TaskTitleMother::dummy()->value(),
                    'status' => TaskStatusMother::dummy()->value(),
                    'content' => TaskContentMother::dummy()->value(),
                ])
            ],
            [
                json_encode([
                    'title' => TaskTitleMother::dummy()->value(),
                    'status' => TaskStatusMother::dummy()->value(),
                    'content' => TaskContentMother::empty()->value(),
                ])
            ],
        ];
    }
}
