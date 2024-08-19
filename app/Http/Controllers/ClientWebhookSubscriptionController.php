<?php

namespace App\Http\Controllers;

use App\Contract\IClientWebhookService;
use App\Http\Requests\NewWebhookSubscription;

class  ClientWebhookSubscriptionController extends Controller
{
    public function __construct(protected IClientWebhookService $webhookService)
    {
    }

    public function newSubscription(NewWebhookSubscription $request)
    {
        return response()->json($this->webhookService->newWebhookSubscription($request));
    }
}
