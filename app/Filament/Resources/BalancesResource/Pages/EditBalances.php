<?php

namespace App\Filament\Resources\BalancesResource\Pages;

use App\Filament\Resources\BalancesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBalances extends EditRecord
{
    protected static string $resource = BalancesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Delete Balance'),
        ];
    }
}
