<?php

namespace App\Providers;

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

         // Auth gates for: User management
         Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Vendor
        Gate::define('vendor_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('vendor_create', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('vendor_edit', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('vendor__view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('vendor__delete', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('vendor__export', function ($user) {
            return in_array($user->role_id, [1]);
        });


        Gate::define('vendor_details_create', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });


        //
    }
}
