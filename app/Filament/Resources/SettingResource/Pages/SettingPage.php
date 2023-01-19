<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class SettingPage extends ManageRecords
{
    // protected static string $resource = SettingResource::class;
    public function getPluralModelLabel(): string
    {
        return __('Settings');
    }
}
