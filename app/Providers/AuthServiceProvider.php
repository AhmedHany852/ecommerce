<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
        // $this->registerPolicies();
        // foreach (config('abilities') as $code => $lable)
        //     Gate::difine($code, function ($users) {
        //         return true;
        //     });
        // Gate::difine('categories.view', function (User $user) {
        //     return true;
        // });
        // Gate::difine('categories.create', function (User $user) {
        // });
        // Gate::difine('categories.update', function (User $user) {
        // });
        // Gate::difine('categories.delete', function (User $user) {
        // });


        //
    }
}
