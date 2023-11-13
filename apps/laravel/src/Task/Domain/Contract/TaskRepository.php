<?php

declare(strict_types=1);

namespace Modules\Task\Domain\Contract;

use Modules\Shared\Domain\ValueObject\IdValueObject;
use Modules\Task\Domain\Task;

interface TaskRepository
{
    public function save(Task $task): void;

    public function update(Task $task): void;

    public function find(IdValueObject $id): ?array;

    public function findAll(): array;

    public function delete(IdValueObject $id): bool;

    public function attachUser(IdValueObject $id, IdValueObject $userId): void;
}
