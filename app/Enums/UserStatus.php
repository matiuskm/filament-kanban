<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum UserStatus: string
{
    use IsKanbanStatus;

    case PENDING = 'pending';
    case ACTIVE = 'active';

    public static function kanbanCases(): array
    {
        return [
            static::PENDING,
            static::ACTIVE,
        ];
    }

    public function getTitle(): string
    {
        return \Illuminate\Support\Str::ucfirst($this->value);
    }
}
