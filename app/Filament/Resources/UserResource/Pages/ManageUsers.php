<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\EditAction;
use Illuminate\Support\Facades\Hash;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->using(function (array $data): Model {
                return static::getModel()::create($data)->assignRole($data['role']);
            })
            ->mutateFormDataUsing(function (array $data): array {
                if (empty($data['password'])) {
                    $data['password'] = Hash::make(123456);
                } else {
                    $data['password'] = Hash::make($data['password']);
                }
                return $data;
            })
            ->label(__('Add')),

        ];
    }
}
