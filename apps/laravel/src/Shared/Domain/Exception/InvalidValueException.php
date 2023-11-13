<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\Exception;

use InvalidArgumentException;

final class InvalidValueException extends InvalidArgumentException
{
    public static function reason(string $msg): InvalidValueException
    {
        return new self('Invalid value because '.$msg);
    }
}
