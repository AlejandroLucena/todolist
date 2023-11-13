<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\Bus;

use Modules\Shared\Domain\ValueObject\IdValueObject;

abstract class Message
{
    private $messageId;

    public function __construct(IdValueObject $messageId)
    {
        $this->messageId = $messageId;
    }

    public function messageId(): IdValueObject
    {
        return $this->messageId;
    }

    abstract public function messageType(): string;
}
