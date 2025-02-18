<?php

namespace App\Providers;

use App\Models\Car;
use App\Policies\CarPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //  protected $policies = [
        //     Car::class => CarPolicy::class,
        // ];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $this->register();
    }
}
