<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Breadcrumbs\Breadcrumbs;
use App\Breadcrumbs\BreadcrumbsManager;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // require_once (base_path('breadcrumbs/admin.php'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('breadcrumbs', BreadcrumbsManager::class);
    }
}
