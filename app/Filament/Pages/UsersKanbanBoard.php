<?php

namespace App\Filament\Pages;

use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class UsersKanbanBoard extends KanbanBoard
{
    protected static string $model = \App\Models\User::class;
    protected static string $statusEnum = \App\Enums\UserStatus::class;

    protected static string $recordTitleAttribute = 'name';

    protected function statuses(): Collection
    {
        return \App\Enums\UserStatus::statuses();
    }

    protected function records(): Collection
    {
        return \App\Models\User::ordered()->get();
    }

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        \App\Models\User::findOrFail($recordId)->update(['status' => $status]);
        \App\Models\User::setNewOrder($toOrderedIds);
    }

    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
        \App\Models\User::setNewOrder($orderedIds);
    }
}
