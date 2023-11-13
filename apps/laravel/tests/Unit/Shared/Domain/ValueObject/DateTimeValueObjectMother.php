<?php

namespace Tests\Unit\Shared\Domain\ValueObject;

use DateTimeImmutable;
use Modules\Shared\Domain\ValueObject\DateTimeValueObject;

class DateTimeValueObjectMother
{
    public static function dummy(): DateTimeValueObject
    {
        return DateTimeValueObject::createFromDateTime(new DateTimeImmutable());
    }

    public static function with(int $year,int $month,int $day): DateTimeValueObject
    {
        return DateTimeValueObject::create($year, $month, $day);
    }
}