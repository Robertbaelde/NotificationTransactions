<?php

namespace RobertBaelde\NotificationTransactions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RobertBaelde\NotificationTransactions\NotificationTransaction
 */
class NotificationTransactionFacade extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'notificationtransaction';
    }
}
