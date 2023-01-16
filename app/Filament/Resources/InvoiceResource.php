<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function getPluralLabel(): string
    {
        return __('Invoices');
    }
    public static function getLabel(): ?string
    {
        return __('Invoice');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('clientname')->label(__('Client Name')),
                PhoneInput::make('clientphone')->initialCountry('sa')->label(__('Client Phone'))->required(),
                // Forms\Components\TextInput::make('clientemail')->label(__('Client Email')),
                Forms\Components\TextInput::make('total')->required()->label(__('Total'))
                ->mask(fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)->thousandsSeparator(','),)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('clientname')
                ->searchable()
                ->sortable()
                ->label(__('Client Name')),
                Tables\Columns\TextColumn::make('clientphone')
                ->getStateUsing(fn ($record) => str_replace('+','00',$record->clientphone) )
                ->searchable()
                ->sortable()
                ->label(__('Client Phone')),
                // Tables\Columns\TextColumn::make('clientemail')->label(__('Client Email')),
                Tables\Columns\TextColumn::make('total')
                ->searchable()
                ->sortable()
                ->label(__('Total')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInvoices::route('/'),
        ];
    }
}
