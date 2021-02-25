<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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


        Gate::before(function ($user) {
            if (!!$user->isSuperUser()) return true;
        });
        foreach (Permission::all() as $permissions) {
            Gate::define($permissions->name, function ($user) use ($permissions) {
                /** @var User $user */
                return $user->hasPermissions($permissions);
            });
        }
    }
}
