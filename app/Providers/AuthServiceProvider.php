<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            if ($user->isAdmin()) {
                return true;
            } else {
                foreach ($user->getPermission() as $permission) {
                    Gate::define($permission->name, function ($user) use ($permission) {
                        return $user->hasRoles($permission->roles);
                    });
                }
            }
        });
    }
}
