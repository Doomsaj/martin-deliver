<?php

use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientRequestController;
use App\Http\Controllers\ClientWebhookSubscriptionController;
use App\Http\Controllers\CourierAuthController;

Route::prefix("courier")->group(function () {
    Route::post('login', [CourierAuthController::class, 'login']);
    Route::middleware(['auth:sanctum', 'token.role:courier'])->group(function () {
    });
});

Route::prefix("client")->group(function () {
    Route::post('login', [ClientAuthController::class, 'login']);
    
    Route::middleware(['auth:sanctum', 'token.role:client'])->group(function () {

        Route::prefix("consignments")->group(function () {
            Route::post("new-request", [ClientRequestController::class, 'placeNewConsignmentRequest']);
            Route::post("cancel-request", [ClientRequestController::class, 'cancelRequest']);
        });

        Route::prefix("webhook")->group(function () {
            Route::post("new-subscription", [ClientWebhookSubscriptionController::class, "newSubscription"]);
        });
    });
});
