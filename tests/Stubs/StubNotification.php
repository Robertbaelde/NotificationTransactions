<?php


namespace RobertBaelde\NotificationTransactions\Tests\Stubs;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StubNotification extends Notification
{
    public function toMail()
    {
        return new MailMessage();
    }
}
