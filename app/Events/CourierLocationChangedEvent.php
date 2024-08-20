<?php

namespace App\Events;

use App\Http\Requests\CourierLocationChangedData;
use App\Models\WebhookSubscription;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourierLocationChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public CourierLocationChangedData $courierLocationChangedData, public ?WebhookSubscription $webhookSub = null)
    {
        //
    }
}
