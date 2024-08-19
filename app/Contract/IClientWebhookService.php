<?php

namespace App\Contract;

use App\Http\Requests\DeleteWebhookSubscription;
use App\Http\Requests\NewWebhookSubscription;

interface IClientWebhookService
{
    function newWebhookSubscription(NewWebhookSubscription $request);

    function deleteWebhookSubscription(DeleteWebhookSubscription $request);
}
