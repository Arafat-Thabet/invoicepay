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
               
                Forms\Components\TextInput::make('invoice_no')->integer()->unique(table: Invoice::class,ignorable:(fn (?Invoice $record) : ?Invoice => $record))->label(__('Invoice No')),
                Forms\Components\TextInput::make('title')->label(__('Invoice Title')),
                Forms\Components\TextInput::make('total')->required()->label(__('Total'))
                ->mask(fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)->thousandsSeparator(','),),
            ]);
    }

    public static function table(Table $table): Table
    {
       $actions=[];
            if(auth()->user()->hasRole(['Supper Admin','Admin']))
            {
          $actions=  [Tables\Actions\DeleteBulkAction::make()]; 
            }
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_no')
                ->searchable()
                ->sortable()
                ->label(__('Invoice No')),
                Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->label(__('Invoice Title')),
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
                Tables\Actions\EditAction::make()->label(__(''))
                ->tooltip(__('Edit')),
                Tables\Actions\DeleteAction::make()->label(__(''))
                ->tooltip(__('Delete')),
                Tables\Actions\Action::make('pay')
                ->url(fn (Invoice $record): string => route('pay_invoice', ['total'=>$record->total,"invoice_no"=>$record->invoice_no,"title"=>$record->title]))
                ->label(__('Payment'))
                ->tooltip(__('Payment'))
                //->icon('heroicon-o-currency')
                ->color('secondary'),
            ])
            ->bulkActions(  $actions);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInvoices::route('/'),
        ];
    }
}
