<?php

namespace App\Contract;

use App\Http\Requests\NewWebhookSubscription;

interface IClientWebhookService
{
    function newWebhookSubscription(NewWebhookSubscription $request);
}
