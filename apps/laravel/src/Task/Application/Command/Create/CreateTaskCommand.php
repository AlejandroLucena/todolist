<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Create;

use Modules\Shared\Services\Commands\Command;

/**
 * Summary of CreateTaskCommand
 */
class CreateTaskCommand extends Command
{
    /**
     * Summary of __construct
     */
    public function __construct(
        private readonly string $title,
        private readonly string $status,
        private readonly ?string $content,
    ) {
    }

    /**
     * Summary of title
     */
    public function title(): string
    {
        return $this->title;
    }

    public function status(): ?string
    {
        return $this->status ? $this->status : 'pending';
    }

    public function content(): ?string
    {
        return $this->content ? $this->content : '';
    }
}
