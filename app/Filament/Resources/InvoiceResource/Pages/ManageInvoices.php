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
                    $message = __('Please, pay yuor invoice on this link: ') . url('/pay_invoice?total='.$this->mountedActionData["total"]);
                    $sms = send_sms($this->mountedActionData["clientphone"], $message);
                    if (send_email('hamzawemughales@gmail.com', $message, 'Payment')) {
                        Notification::make()
                                ->success()
                                ->title(__('Successfully'))
                                ->body(__('Incoive has been sent successfully.'))
                                ->persistent()
                                ->send();
                    } else {
                        if (!$this->record->team->subscribed()) {
                            Notification::make()
                                ->warning()
                                ->title('Faild!')
                                ->body('Sorry, Faild to send, try again later!')
                                ->persistent()
                                ->send();
                            $action->cancel();
                        }
                    }
                })
                ->label(__('Send Invoice')),
        ];
    }
}
