<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Exception;

use InvalidArgumentException;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Symfony\Component\HttpFoundation\Response;

final class AlreadyExists extends InvalidArgumentException
{
    public static function withUserId(IdValueObject $id): AlreadyExists
    {
        return new self(\sprintf('Task with id %s already exists.', $id->value()), Response::HTTP_BAD_REQUEST);
    }
}
