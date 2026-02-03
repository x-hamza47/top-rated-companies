<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer("*", function($view){
            $categories = Cache::rememberForever('nav_categories', function(){
                return Category::with(['services' => function ($q) {
                    $q->where('status', 1)->select('id', 'category_id', 'name', 'slug')->take(7);
                }])->where('status', 1)->get();
            });

            $view->with('navCategories', $categories);
        });

        Gate::define('admin', function($user){
            return $user->role === "admin";
        });
        Gate::define('company', function($user){
            return $user->role === "company";
        });
        Gate::define('user', function($user){
            return $user->role === "user";
        });
    }
}
