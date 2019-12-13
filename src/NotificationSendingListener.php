<?php


namespace RobertBaelde\NotificationTransactions;


use Illuminate\Notifications\Events\NotificationSending;

class NotificationSendingListener
{
    private $transaction;

    public function __construct(NotificationTransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function handle(NotificationSending $notificationSendingEvent): ?bool
    {
//        dd($this->transaction->isActive());
        if (!$this->transaction->isActive()) {
            return null;
        }

        $this->transaction->addNotification($notificationSendingEvent);
        return false;
    }
}
