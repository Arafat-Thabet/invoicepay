<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AssociateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\Filter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function getPluralLabel(): string
    {
        return __('Users');
    }
    public static function getLabel(): ?string
    {
        return __('User');
    }
    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('id', '!=', 1);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label(__('Name')),
                Forms\Components\TextInput::make('email')->email()->required()->label(__('Email')),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label(__('Password')),
                Forms\Components\Select::make('role')
                    ->label(__('Roles'))
                    ->options(Role::where('id', "!=", 1)->pluck('name', 'name'))
                    ->hidden(fn($record)=> ($record && $record->id == 2) ? true : false)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        // dd(env('APP_ENV'));
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label(__('Email'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('role')->label(__('Roles')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        if (empty($data['password'])) {
                            unset($data['password']);
                        } else {
                            $data['password'] = Hash::make($data['password']);
                        }
                        return $data;
                    })
                    ->using(function (Model $record, array $data): Model {
                        $record->update($data);
                        $record->syncRoles($data['role']);

                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()->hidden(fn($record)=>$record->id == 2),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
