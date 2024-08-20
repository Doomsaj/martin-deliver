<?php

namespace App\Services;

use App\Contract\IClientWebhookService;
use App\Http\Requests\NewWebhookSubscription;
use App\Models\WebhookSubscription;

class ClientWebhookService implements IClientWebhookService
{
    function newWebhookSubscription(NewWebhookSubscription $request): array
    {
        $data = $request->validated();

        $subscription = WebhookSubscription::create([
            "url" => $data["url"],
            "method" => $data["method"],
            "secret" => $data["secret"],
            "event" => $data["event"],
            "client_id" => auth()->user()->id,
        ]);

        return ["subscription" => $subscription, "created" => true];
    }
}
