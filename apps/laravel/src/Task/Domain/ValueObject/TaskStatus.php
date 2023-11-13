<?php

declare(strict_types=1);

namespace Modules\Task\Domain\ValueObject;

use Modules\Shared\Domain\ValueObject\EnumValueObject;

class TaskStatus extends EnumValueObject
{
    public const PENDING = 'pending';
    public const INPROGRESS = 'in_progress';
    public const COMPLETED = 'completed';

}
