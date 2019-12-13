<?php


namespace RobertBaelde\NotificationTransactions\Tests\Stubs;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserStub extends Model
{
    use Notifiable;
}
