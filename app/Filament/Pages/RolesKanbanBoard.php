<?php

namespace App\Filament\Pages;

use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class RolesKanbanBoard extends KanbanBoard
{
    protected static string $model = \App\Models\User::class;
    protected static string $statusEnum = \App\Enums\UserRole::class;

    protected static string $recordTitleAttribute = 'name';

    protected static string $recordStatusAttribute = 'role';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'User Roles';

    protected function statuses(): Collection
    {
        return \App\Enums\UserRole::statuses();
    }

    protected function records(): Collection
    {
        return \App\Models\User::where('status', \App\Enums\UserStatus::ACTIVE)->ordered()->get();
    }

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        \App\Models\User::findOrFail($recordId)->update(['role' => $status]);
        \App\Models\User::setNewOrder($toOrderedIds);
    }

    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
        \App\Models\User::setNewOrder($orderedIds);
    }
}
