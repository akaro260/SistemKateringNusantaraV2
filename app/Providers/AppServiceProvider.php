<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // JEBAKAN N+1: kunci mati Lazy Loading di luar production.
        // Kalau ada relasi yang belum di-eager-load lalu diakses di view/controller,
        // Laravel akan langsung melempar LazyLoadingViolationException
        // (bukan diam-diam menjalankan ratusan query tambahan).
        Model::preventLazyLoading(! app()->isProduction());
    }
}
