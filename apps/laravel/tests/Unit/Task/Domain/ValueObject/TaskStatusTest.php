<?php
namespace Tests\Unit\Task\Domain\ValueObject;

use Modules\Shared\Domain\Exception\InvalidValueException;
use Modules\Task\Domain\ValueObject\TaskStatus;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{

    static public function valid_values(){
        return [
            ['pending'],
            ['in_progress'],
            ['completed'],
        ];
    }
    
    /**
     * @test
     * @dataProvider valid_values
     * @return void
     */
    public function shouldCreateTaskStatusOkValues(string $value): void
    {
        $return = TaskStatus::from($value);

        $this->assertEquals($value, $return->value()); 
    }
    
    static public function invalid_values(){
        return [
            ['WRONG'],
            ['VALUES'],
        ];
    }

    /**
     * @test
     * @dataProvider invalid_values
     * @return void
     */
    public function shouldCreateTaskStatusKoValue($value): void
    {
        $this->expectException(InvalidValueException::class);
        TaskStatus::from($value);
    }
}