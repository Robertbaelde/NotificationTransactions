<?php

namespace RobertBaelde\NotificationTransactions;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class NotificationTransactionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Event::listen(
            NotificationSending::class,
            NotificationSendingListener::class
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('notificationtransaction', function () {
            return resolve(NotificationTransaction::class);
        });

        $this->app->singleton(NotificationTransaction::class, function () {
            return new NotificationTransaction(
                resolve(ChannelManager::class)
            );
        });
    }
}
