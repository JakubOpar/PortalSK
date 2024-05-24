<?php

namespace App\Providers;

use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', [AdminPolicy::class, 'access']);
    }
}
