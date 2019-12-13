<?php

namespace RobertBaelde\NotificationTransactions\Tests;

use Illuminate\Notifications\Events\NotificationSending;
use Orchestra\Testbench\TestCase;
use RobertBaelde\NotificationTransactions\NotificationSendingListener;
use RobertBaelde\NotificationTransactions\NotificationTransaction;
use RobertBaelde\NotificationTransactions\Tests\Stubs\StubNotification;
use RobertBaelde\NotificationTransactions\Tests\Stubs\UserStub;

class NotificationSendingListenerTest extends TestCase
{
    /** @test */
    public function the_listener_returns_null_when_transaction_is_not_active(): void
    {
        $listener = resolve(NotificationSendingListener::class);
        $result = $listener->handle(new NotificationSending(
            new UserStub(),
            new StubNotification(),
            'mail'
        ));

        $this->assertNull($result);
    }

    /** @test */
    public function the_listener_returns_false_when_transaction_is_active(): void
    {
        $transaction = resolve(NotificationTransaction::class);
        $transaction->start();

        $listener = new NotificationSendingListener($transaction);
        $result = $listener->handle(new NotificationSending(
            new UserStub(),
            new StubNotification(),
            'mail'
        ));

        $this->assertFalse($result);
    }
}
