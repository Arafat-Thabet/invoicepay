<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Permission;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;


class ManageRoles extends ManageRecords
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->using(function (array $data): Model {
                return static::getModel()::create($data)->givePermissionTo($data['permissions']);
            })
            ->label(__('Add')),
        ];
    }
}
