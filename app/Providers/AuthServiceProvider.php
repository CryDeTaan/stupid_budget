<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('accessAccount', function ($user, $account) {
            return $user->id == $account->user_id;
        });

        Gate::define('accessCategory', function ($user, $category) {
            return $user->id == $category->user_id;
        });

        Gate::define('accessSubcategory', function ($user, $subcategory) {
            return $user->id == $subcategory->user_id;
        });

        Gate::define('accessIncome', function ($user, $income) {
            return $user->id == $income->user_id;
        });

        Gate::define('accessExpense', function ($user, $expense) {
            return $user->id == $expense->user_id;
        });


    }
}
