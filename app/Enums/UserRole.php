<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum UserRole: string
{
    use IsKanbanStatus;

    case USER = 'user';
    case ADMIN = 'admin';

    public static function kanbanCases(): array
    {
        return [
            static::USER,
            static::ADMIN,
        ];
    }

    public function getTitle(): string
    {
        return \Illuminate\Support\Str::ucfirst($this->value);
    }
}
