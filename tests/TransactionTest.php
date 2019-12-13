<?php

namespace RobertBaelde\NotificationTransactions\Tests;

use Illuminate\Notifications\Events\NotificationSending;
use Orchestra\Testbench\TestCase;
use RobertBaelde\NotificationTransactions\NotificationTransaction;
use RobertBaelde\NotificationTransactions\Tests\Stubs\StubNotification;
use RobertBaelde\NotificationTransactions\Tests\Stubs\UserStub;

class TransactionTest extends TestCase
{
    /** @test */
    public function a_transaction_can_be_started(): void
    {
        $transacton = resolve(NotificationTransaction::class);
        $this->assertFalse($transacton->isActive());

        $transacton->start();

        $this->assertTrue($transacton->isActive());

        $transacton->commit();

        $this->assertFalse($transacton->isActive());
    }

    /** @test */
    public function it_sends_all_notifications_on_commit()
    {
        $transaction = resolve(NotificationTransaction::class);
        $transaction->addNotification(
            new NotificationSending(
                new UserStub(),
                new StubNotification(),
                'mail'
            )
        );

        $transaction->commit();
        $this->markTestIncomplete('add assertion');
    }

    /** @test */
    public function transactions_can_be_rolled_back()
    {
        $transaction = resolve(NotificationTransaction::class);
        $transaction->addNotification(
            new NotificationSending(
                new UserStub(),
                new StubNotification(),
                'mail'
            )
        );

        $this->assertCount(1, $transaction->getPendingNotifications());

        $transaction->rollBack();

        $this->assertCount(0, $transaction->getPendingNotifications());
    }
}
