<?php

declare(strict_types=1);

namespace Modules\Task\Application\Command\Update;

use Modules\Shared\Services\Commands\Command;

/**
 * Summary of UpdateTaskCommand
 */
class UpdateTaskCommand extends Command
{
    public function __construct(
        private readonly int $id,
        private readonly ?string $title = null,
        private readonly ?string $status = null,
        private readonly ?string $content = null,
    ) {
    }

    /**
     * Summary of id
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Summary of title
     */
    public function title(): ?string
    {
        return $this->title;
    }

    public function status(): ?string
    {
        return $this->status;
    }
    /**
     * Summary of content
     */
    public function content(): ?string
    {
        return $this->content;
    }
}
