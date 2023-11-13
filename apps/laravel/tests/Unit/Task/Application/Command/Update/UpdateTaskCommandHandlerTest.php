<?php

declare(strict_types=1);

use Mockery\MockInterface;
use Modules\Task\Application\Command\Update\UpdateTaskCommand;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskUpdater;
use Modules\Task\Application\Command\Update\UpdateTaskCommandHandler;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;

class UpdateTaskCommandHandlerTest extends TaskTestCase
{
    /**
     * Summary of taskUpdater
     * @var UpdateTaskCommandHandler
     */
    protected UpdateTaskCommand|MockInterface $updateTaskCommand;
    protected UpdateTaskCommandHandler $updateTaskCommandHandler;
    protected TaskUpdater|MockInterface $taskUpdater;

    public function setUp(): void
    {
        $this->taskUpdater = $this->getMockBuilder(
            TaskUpdater::class,
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

        $this->updateTaskCommandHandler = new UpdateTaskCommandHandler($this->taskUpdater);
        
        $this->expectNotToPerformAssertions();
        
        $this->updateTaskCommandHandler->__invoke(new UpdateTaskCommand(
            ...$payload
        ));
    }
    
    public static function validValues()
    {
        return [
            [
                json_encode([
                    'id' => IdValueObjectMother::dummy()->value(),
                    'title' => TaskTitleMother::dummy()->value(),
                    'status' => TaskStatusMother::dummy()->value(),
                    'content' => TaskContentMother::dummy()->value(),
                ])
            ],
            [
                json_encode([
                    'id' => IdValueObjectMother::dummy()->value(),
                    'title' => TaskTitleMother::dummy()->value(),
                    'status' => TaskStatusMother::dummy()->value(),
                    'content' => TaskContentMother::empty()->value(),
                ])
            ],
        ];
    }

}