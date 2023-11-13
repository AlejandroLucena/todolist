<?php

namespace Tests\Unit\Shared\Domain\ValueObject;

use Modules\Shared\Domain\ValueObject\DateTimeValueObject;
use Tests\Unit\Task\TaskTestCase;

class DateTimeValueObjectTest extends TaskTestCase
{

    /**
     * @test
     * @return void
     */
    public function shouldCreateDateTimeValueObjectOk(): void
    {
        $day = random_int(1, 28);
        $month = random_int(1, 12);
        $year = random_int(1900, 2030);

        $return = DateTimeValueObject::create($year, $month, $day);

        $this->assertEquals(DateTimeValueObject::class, get_class($return));        
    }

}