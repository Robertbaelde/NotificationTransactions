<?php

namespace RobertBaelde\NotificationTransactions;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Support\Collection;

class NotificationTransaction
{
    protected $active = false;

    private $notificationEvents;

    private $manager;

    public function __construct(ChannelManager $manager)
    {
        $this->notificationEvents = collect();
        $this->manager = $manager;
    }

    public function start(): void
    {
        $this->active = true;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function addNotification(NotificationSending $notificationEvent): void
    {
        $this->notificationEvents->push($notificationEvent);
    }

    public function getPendingNotifications(): Collection
    {
        return $this->notificationEvents;
    }

    public function commit($toQueue = false): void
    {
        $this->active = false;

        $this->notificationEvents->each(function (NotificationSending $notificationEvent) use ($toQueue) {
            if ($toQueue) {
                dispatch(function () use ($notificationEvent) {
                    $this->manager->sendNow($notificationEvent->notifiable, $notificationEvent->notification, [$notificationEvent->channel]);
                });
                return;
            }
            $this->manager->sendNow($notificationEvent->notifiable, $notificationEvent->notification, [$notificationEvent->channel]);
        });
    }

    public function commitToQueue(): void
    {
        $this->commit(true);
    }

    public function rollback(): void
    {
        $this->active = false;
        $this->notificationEvents = collect([]);
    }
}
