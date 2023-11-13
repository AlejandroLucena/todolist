<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\ValueObject;

class StringValueObject
{
    public function __construct(private readonly ?string $value = '')
    {
    }

    public function value()
    {
        return $this->value ? $this->value : '';
    }

    public function __toString()
    {
        return $this->value();
    }

    public static function from(string $value)
    {
        return new self($value);
    }
}
