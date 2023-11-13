<?php

namespace Tests\Unit\Shared\Domain\ValueObject;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Tests\Unit\Task\TaskTestCase;

class IdValueObjectTest extends TaskTestCase
{

    /**
     * @test
     * @return void
     */
    public function shouldCreateIdValueObjectOk(): void
    {
        $value = random_int(1, 1000);
        
        $return = IdValueObject::from($value);

        $this->assertEquals(IdValueObject::class, get_class($return));        
        $this->assertEquals($value, $return->value());        
    }

}