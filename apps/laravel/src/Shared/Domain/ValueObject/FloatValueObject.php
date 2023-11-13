<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\ValueObject;

class FloatValueObject
{
    protected $value;

    public function __construct(float $value = null)
    {
        $this->value = $value;
    }

    public function value(): ?float
    {
        return $this->value;
    }

    public function random(): self
    {
        return new self(rand());
    }

    public function equalsTo(FloatValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(FloatValueObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public static function from(float $value): self
    {
        return new self($value);
    }
}
