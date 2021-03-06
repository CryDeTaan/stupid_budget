<?php

namespace App\Providers;

use App\Category;
use App\Subcategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('match_category', function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            if (Subcategory::find($value)->category_id == $data['category_id']) {
                return true;
            } elseif (Subcategory::find($value)->subcategoryName == $data['category_id']) {
                return true;
            }
                return false;
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
