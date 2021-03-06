# laravel5-imap-authentication
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dd67b18d6b9044169f4cd540cca61fba)](https://www.codacy.com/app/laravel-enso/laravel5-imap-authentication?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/laravel5-imap-authentication&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85708982/shield?branch=master)](https://styleci.io/repos/85708982)
[![Total Downloads](https://poser.pugx.org/laravel-enso/imapauth/downloads)](https://packagist.org/packages/laravel-enso/imapauth)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/imapauth/version)](https://packagist.org/packages/laravel-enso/imapauth)

An authentication provider for Laravel 5 that allows you to authenticate via IMAP.

Heavily inspired by peckrob's package.

## Installation

Add the following line to the `require` section of your `composer.json`:

```json
{
    "require": {
        "peckrob/laravel5-imap-authentication": "dev-master"
    }
}
```

Update your packages with ```composer update``` or install with ```composer install```.

## Laravel 5

### Setup

Add the ServiceProvider to the `providers` array in `app/config/app.php`.

```
        App\Providers\AppServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        ...
        peckrob\Laravel5ImapAuthentication\ImapAuthServiceProvider::class,
```

In your `app/config/auth.php`, set the authentication driver to `imap`.

```
    'driver' => 'imap',
```

### Configuration

By default it will attempt to connect to localhost. If you want something different, add `IMAP_AUTH_SERVER`, `IMAP_AUTH_PORT`, `IMAP_PARAMETERS` to the **.env** file:

```
IMAP_AUTH_SERVER
IMAP_PORT
IMAP_PARAMETERS
```

## Contribute

Contributions are welcome. :)

https://github.com/peckrob/laravel5-imap-authentication
