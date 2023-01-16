<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\CreateAction;

class ManageInvoices extends ManageRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()

            ->before(function (CreateAction $action) {
                // dd(77777, $this);
                // if (! $this->record->team->subscribed()) {
                    Notification::make()
                        ->warning()
                        ->title('You don\'t have an active subscription!')
                        ->body('Choose a plan to continue.')
                        ->persistent()
                        // ->actions([
                        //     Action::make('subscribe')
                        //         ->button()
                                // ->url(route('subscribe'), shouldOpenInNewTab: true),
                        // ])
                        ->send();

                        $action->cancel();
                        dd(4444);
                    // $action->halt();
                // }
            }),
        ];
    }
}
