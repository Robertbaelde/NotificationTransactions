# Transactions for Laravel Notifications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/robertbaelde/notificationtransactions.svg?style=flat-square)](https://packagist.org/packages/robertbaelde/notificationtransactions)
[![Build Status](https://img.shields.io/travis/robertbaelde/notificationtransactions/master.svg?style=flat-square)](https://travis-ci.org/robertbaelde/notificationtransactions)
[![Quality Score](https://github.styleci.io/repos/227851567/shield)](https://github.styleci.io/repos/227851567/shield)
[![Total Downloads](https://img.shields.io/packagist/dt/robertbaelde/notificationtransactions.svg?style=flat-square)](https://packagist.org/packages/robertbaelde/notificationtransactions)

This package holds off the sending of notifications until the transactions is commit. This is usefull if you trigger notifications inside a database transaction for example.   

## Installation

You can install the package via composer:

```bash
composer require robertbaelde/notificationtransactions
```

## Usage

``` php
 // Start a transaction 
 NotificationTransaction::start();
 
 // Trigger your notifications as usual 
 $user->notify(new ImportantNotification());
 
 // commit the notifications when you want to send them
 \NotificationTransaction::commit();
 
  // rollback the notifications when something failed and notifications must not be send. 
  \NotificationTransaction::rollback();
 
 // You can also use DI instead of the Facade. 
 $notificationTransaction = resolve(NotificationTransaction::class);
 $notificationTransaction->start();


```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email robert@baelde.nl instead of using the issue tracker.

## Credits

- [RobertBaelde](https://github.com/robertbaelde)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
