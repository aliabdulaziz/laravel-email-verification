# laravel-email-verification
This Laravel package provides a simple solution for email verification.

## Requirements
- Laravel 5.3+



## Screenshots
![Email is not verified](https://raw.githubusercontent.com/Aliabdulaziz/laravel-email-verification/master/screenshots/01.PNG "Email is not verified")

![Verification Mail](https://raw.githubusercontent.com/Aliabdulaziz/laravel-email-verification/master/screenshots/02.PNG "Verification Mail")

![Verification failed](https://raw.githubusercontent.com/Aliabdulaziz/laravel-email-verification/master/screenshots/03.PNG "Verification failed")

![Email is verified](https://raw.githubusercontent.com/Aliabdulaziz/laravel-email-verification/master/screenshots/04.PNG "Email is verified")



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
php artisan vendor:publish --provider="Aliabdulaziz\LaravelEmailVerification\LaravelEmailVerificationServiceProvider" --tag=config
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

### Example

```php
Route::middleware(['web', 'auth', 'verifyEmail'])->group(function () {

	// Only users with verified emails can access this route
	Route::get('verified-email', function () {
		echo "Your email is verified!";
	});

});
```


## Customization

To customize the package default views publish them to your views folder by running the following command:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelEmailVerification\LaravelEmailVerificationServiceProvider" --tag=views
```

Now make whatever customization you want on the published views.

