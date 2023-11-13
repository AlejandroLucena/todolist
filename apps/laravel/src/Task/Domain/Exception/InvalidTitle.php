<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Exception;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

final class InvalidTitle extends InvalidArgumentException
{
    public static function reason(string $msg): InvalidTitle
    {
        return new self('Invalid Task title because '.$msg, Response::HTTP_BAD_REQUEST);
    }
}
