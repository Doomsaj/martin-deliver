<?php

namespace App\Providers;

use App\Contract\IClientRequestService;
use App\Contract\IClientWebhookService;
use App\Contract\ICourierService;
use App\Services\ClientRequestService;
use App\Services\ClientWebhookService;
use App\Services\CourierService;
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
        $this->app->bind(ICourierService::class, CourierService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
