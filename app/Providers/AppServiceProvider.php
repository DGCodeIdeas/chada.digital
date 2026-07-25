<?php
namespace App\Providers;

use App\Services\PreviewService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PreviewService::class);
    }

    public function boot(): void
    {
        //
    }
}
