<?php

declare(strict_types=1);

use Mockery\MockInterface;
use Modules\Task\Application\Command\Delete\DeleteTaskCommand;
use Tests\Unit\Task\TaskTestCase;
use Modules\Task\Domain\Service\TaskRemover;
use Modules\Task\Application\Command\Delete\DeleteTaskCommandHandler;
use Tests\Unit\Shared\Domain\ValueObject\IdValueObjectMother;

class DeleteTaskCommandHandlerTest extends TaskTestCase
{
    /**
     * Summary of taskRemover
     * @var DeleteTaskCommandHandler
     */
    protected DeleteTaskCommand|MockInterface $deleteTaskCommand;
    protected DeleteTaskCommandHandler $deleteTaskCommandHandler;
    protected TaskRemover|MockInterface $taskRemover;

    public function setUp(): void
    {
        $this->taskRemover = $this->getMockBuilder(
            TaskRemover::class,
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

        $this->deleteTaskCommandHandler = new DeleteTaskCommandHandler($this->taskRemover);

        $this->expectNotToPerformAssertions();

        $this->deleteTaskCommandHandler->__invoke(new DeleteTaskCommand(
            ...$payload
        ));
    }

    public static function validValues()
    {
        return [
            [
                json_encode([
                    'id' => IdValueObjectMother::dummy()->value(),
                ])
            ],
        ];
    }
}
