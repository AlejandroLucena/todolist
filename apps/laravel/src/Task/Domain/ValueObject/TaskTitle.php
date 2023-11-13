<?php

declare(strict_types=1);

namespace Modules\Task\Domain\ValueObject;

use Modules\Shared\Domain\Exception\InvalidValueException;
use Modules\Shared\Domain\ValueObject\StringValueObject;

final class TaskTitle extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureFormatIsValid($value);

        parent::__construct($value);
    }

    public static function from(string $value): self
    {
        return new self($value);
    }

    private function ensureFormatIsValid(string $value): void
    {
        if (strlen($value) < 3) {
            throw new InvalidValueException($value);
        }
    }
}
