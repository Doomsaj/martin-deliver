<?php

namespace App\Http\Requests;

class CallWebhookData
{
    public function __construct(public string $url, public string $secret, public string $method, public array $data)
    {
    }
}
