<?php

namespace Tests\Unit\Task\Domain\ValueObject;

use Modules\Task\Domain\ValueObject\TaskContent;
use Faker\Factory;
use Tests\Unit\Task\TaskTestCase;

class TaskContentTest extends TaskTestCase
{
    /**
     * @test
     * @return void
     */
    public function shouldCreateTaskContentOk(): void
    {
        $paragraph = Factory::create()->paragraph();

        $return = TaskContent::from($paragraph);

        $this->assertEquals($paragraph, $return->value()); 
    }

    /**
     * @test
     * @return void
     */
    public function shouldCreateTaskContentKo(): void
    {
        $value = 1;
        $expected = $value;

        $return = TaskContent::from($value);

        $this->assertNotEquals(gettype($expected), gettype($return->value())); 
    }

}