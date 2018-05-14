<?php

namespace Aliabdulaziz\LaravelEmailVerification;

use Illuminate\Support\ServiceProvider;

use App\User;
use Aliabdulaziz\LaravelEmailVerification\Observers\UserObserver;

class LaravelEmailVerificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Observe User Events
        User::observe(UserObserver::class);

        // Load Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations', 'laravelemailverification');

        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php', 'laravelemailverification');

        // Load Views
        $this->loadViewsFrom(__DIR__.'/views', 'laravelemailverification');

        // Publish Config File
        $this->publishes([
        __DIR__.'/config/laravelemailverification.php' => config_path('laravelemailverification.php'),
        ], 'config');

        // Publish Views
        $this->publishes([
        __DIR__.'/views' => resource_path('views/vendor/laravelemailverification'),
        ], 'views');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind('email-verification', function ($app) {
            return new LaravelEmailVerification;
        });*/
    }
}