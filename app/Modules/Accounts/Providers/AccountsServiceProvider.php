<?php

namespace App\Modules\Accounts\Providers;

use App\Modules\Accounts\Repositories\Contracts\UserRepository;
use App\Modules\Accounts\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AccountsServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepository::class => EloquentUserRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
