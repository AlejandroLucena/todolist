<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\Bus;

use Modules\Shared\Domain\ValueObject\IdValueObject;

abstract class Request extends Message
{
    public function requestId(): IdValueObject
    {
        return $this->messageId();
    }
}
