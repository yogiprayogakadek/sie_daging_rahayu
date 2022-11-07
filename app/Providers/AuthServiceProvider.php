<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function($user) {
            return $user->role == 'Admin';
        });

        Gate::define('owner', function($user) {
            return $user->role == 'Owner';
        });

        Gate::define('staff', function($user) {
            return $user->role == 'Staff';
        });

        Gate::define('adminAndStaff', function($user){
            return $user->role == 'Admin' || $user->role == 'Staff';
        });
    }
}
