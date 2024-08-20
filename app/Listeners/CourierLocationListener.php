<?php

namespace App\Listeners;

use App\Events\CourierLocationChangedEvent;
use App\Http\Requests\CallWebhookData;
use App\Jobs\CallClientWebhook;
use App\Models\CourierLocation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class CourierLocationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'courier_location_events';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handleLocationChange(CourierLocationChangedEvent $event): void
    {
        $changeData = $event->courierLocationChangedData;
        $webhookSub = $event->webhookSub;

        Log::info("salammm");

        if ($webhookSub) {
            $data = [
                "latitude" => $changeData->latitude,
                "longitude" => $changeData->longitude,
                "timestamp" => now(),
                "consignment_code" => $changeData->consignmentCode
            ];

            $callWebhookData = new CallWebhookData($webhookSub->url, $webhookSub->secret, $webhookSub->method, $data);

            CallClientWebhook::dispatch($callWebhookData);
        }

        CourierLocation::create([
            "latitude" => $changeData->latitude,
            "longitude" => $changeData->longitude,
            "consignment_id" => $changeData->consignmentId,
            "courier_id" => $changeData->courierId
        ]);
    }
}
