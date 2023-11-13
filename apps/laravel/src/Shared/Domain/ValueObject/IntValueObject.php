<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\ValueObject;

class IntValueObject
{
    protected $value;

    public function __construct(int $value = null)
    {
        $this->value = $value;
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function random(): self
    {
        return new self(rand());
    }

    public function equalsTo(IntValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public static function from(int $value): ?self
    {
        return new self($value);
    }
}
