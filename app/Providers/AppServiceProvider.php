<?php

namespace App\Providers;

use App\Contract\IClientRequestService;
use App\Contract\IClientWebhookService;
use App\Services\ClientRequestService;
use App\Services\ClientWebhookService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IClientRequestService::class, ClientRequestService::class);
        $this->app->bind(IClientWebhookService::class, ClientWebhookService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
