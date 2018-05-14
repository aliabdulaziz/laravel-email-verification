# laravel-extended-user
This Laravel package adds profile page, account page, and extra features to Laravel's built-in Auth system

## Requirements
- Bootstrap 4
- Laravel 5.3+



## Screenshots
(will be added by tomorrow)



## Installation

> It is recommended to install this package in a fresh installation of Laravel.

### Laravel's built-in Auth System

This package is integrated with Laravel's built-in Auth System, 
so you must first run this command if you have not run it yet:

```shell
php artisan make:auth
```
Now go to your (env) file and make sure that you have selected your database. 

### Install the package using composer

Now install the package using composer by running the following command:

```shell
composer require aliabdulaziz/laravel-email-verification
```

### Add the service provider (for Laravel < 5.5)

Go to: (Your Laravel App) --> config --> app.php

and add the following line under 'Package Service Providers' comment:

```php
Aliabdulaziz\LaravelExtendedUser\LaravelEmailVerificationServiceProvider::class
```

### Publish the config file

Run the following command to publish the package config file:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelEmailVerificationServiceProvider" --tag=config
```

The config file is named (laravelemailverification.php) and will be located in the 'config' folder.


### Migrate

Run the artisan migrate command to create the users table:

> this command will also migrate the package migration file by which the email_verification field is added to the users table.

```shell
php artisan migrate
```

### Config Mail Driver

go to your (env) file and make sure that you have configured your mail driver. 


## Middleware

Go to: (Your Laravel App) --> app --> Http --> Kernal.php

and add the following middleware to the $routeMiddleware array:

```php
'verifyEmail' => \Aliabdulaziz\LaravelEmailVerification\Middleware\VerifyEmail::class,
```

Now you can use this middleware on the routes that you want to prevent from being accessed by the users who did not verify their emails.



## Customization

To customize the package default views publish them to your views folder by running the following command:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelEmailVerificationServiceProvider" --tag=views
```

Now make whatever customization you want on the published views.

