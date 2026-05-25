<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Scopes\HideDevScope;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
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
        \Illuminate\Support\Facades\Auth::provider('dev_eloquent', function ($app, array $config) {
            return new \App\Auth\DevUserProvider($app['hash'], $config['model']);
        });
        Paginator::useTailwind();

        View::composer('*', function ($view) {
            $categories = Cache::rememberForever('nav_categories', function () {
                return Category::with(['services' => function ($q) {
                    $q->where('status', 1)->select('id', 'category_id', 'name', 'slug')->orderBy('id')->take(6);
                }])->where('status', 1)->get();
            });

            $view->with('navCategories', $categories);
        });

        if (Schema::hasTable('users')) {
            $devCount = User::withoutGlobalScope(HideDevScope::class)
                ->where('role', 'dev')
                ->count();

            if ($devCount === 0) {
                Log::warning('⚠️ Dev account is missing.');
            } elseif ($devCount > 1) {
                Log::critical('🚨 Multiple dev accounts detected. Investigate immediately.');
            }
        }

        Gate::define('admin', function ($user) {
            return $user->role === 'admin' || $user->role === 'dev';
        });
        Gate::define('company', function ($user) {
            return $user->role === 'company';
        });
        Gate::define('dev', function ($user) {
            return $user->role === 'dev';
        });
        Gate::define('user', function ($user) {
            return $user->role === 'user';
        });

    }
}
