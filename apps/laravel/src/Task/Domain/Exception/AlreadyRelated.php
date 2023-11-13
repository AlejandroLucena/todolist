<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Exception;

use InvalidArgumentException;
use Modules\Shared\Domain\ValueObject\IdValueObject;
use Symfony\Component\HttpFoundation\Response;

final class AlreadyRelated extends InvalidArgumentException
{
    public static function withUserId(IdValueObject $userId): AlreadyRelated
    {
        return new self(\sprintf('Task already related to User wih id %s.', $userId->value()), Response::HTTP_BAD_REQUEST);
    }
}
