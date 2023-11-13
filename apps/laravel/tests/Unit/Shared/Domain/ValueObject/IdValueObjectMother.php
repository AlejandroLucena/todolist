<?php

namespace Tests\Unit\Shared\Domain\ValueObject;

use Modules\Shared\Domain\ValueObject\IdValueObject;

class IdValueObjectMother
{
    public static function dummy(): IdValueObject
    {
        return IdValueObject::from(random_int(1,1000));
    }

    public static function with(int $id): IdValueObject
    {
        return IdValueObject::from($id);
    }
}