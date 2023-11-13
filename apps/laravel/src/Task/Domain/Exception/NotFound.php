<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Exception;

use InvalidArgumentException;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Symfony\Component\HttpFoundation\Response;

final class NotFound extends InvalidArgumentException
{
    public static function with(IdValueObject $id): NotFound
    {
        return new self(\sprintf('Task with id %s cannot be found.', $id->value()), Response::HTTP_NOT_FOUND);
    }

}
