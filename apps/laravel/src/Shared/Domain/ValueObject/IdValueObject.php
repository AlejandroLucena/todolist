<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\ValueObject;

class IdValueObject extends IntValueObject
{
    public static function from(string|int $value = null): ?self
    {
        return $value ? new self((int) $value) : null;
    }
}
