<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define admin role-based permissions
        Gate::define('admin-access', function (Admin $admin) {
            return $admin->is_active;
        });

        Gate::define('super-admin', function (Admin $admin) {
            return $admin->role === 'super_admin';
        });

        Gate::define('admin', function (Admin $admin) {
            return in_array($admin->role, ['super_admin', 'admin']);
        });

        Gate::define('manager', function (Admin $admin) {
            return in_array($admin->role, ['super_admin', 'admin', 'manager']);
        });
    }
} 