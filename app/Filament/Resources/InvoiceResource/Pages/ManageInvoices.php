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
                   $total= $this->mountedActionData["total"];
                   $invoice_no= $this->mountedActionData["invoice_no"];
                    $message = __('Please, pay your invoice on this link: ') . url('/pay_invoice?total='.$total.'&invoice_no='. $invoice_no);
                    $sms = send_sms($this->mountedActionData["clientphone"], $message);
                    if (true or send_email(getSetting('company_email'), $message, 'Payment')) {
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
