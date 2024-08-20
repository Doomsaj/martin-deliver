<?php

namespace App\Listeners;

use App\Enums\WebhookTriggerEvents;
use App\Events\ConsignmentStatusChanged;
use App\Http\Requests\CallWebhookData;
use App\Jobs\CallClientWebhook;
use App\Models\Consignment;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ConsignmentStatusListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'consignment_status_events';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handleStatusChanged(ConsignmentStatusChanged $event): void
    {
        try {
            $data = $event->data;
            $consignment = Consignment::with(["client", "client.webhookSubscriptions"])->where(["code" => $data->consignmentCode])->first();
            $consignmentClient = $consignment->client;

            $webhookSubs = $consignmentClient->webhookSubscriptions->where("event", "=", WebhookTriggerEvents::CONSIGNMENT_STATUS_CHANGED)->get()->toArray();

            if (count($webhookSubs) > 0) {
                foreach ($webhookSubs as $webhookSub) {
                    $data = [
                        "consignmentCode" => $data->consignmentCode,
                        "prev_status" => $data->prevStatus,
                        "current_status" => $data->currentStatus,
                        "timestamp" => $data->date
                    ];

                    $callWebhookData = new CallWebhookData($webhookSub->url, $webhookSub->secret, $webhookSub->method, $data);
                    CallClientWebhook::dispatch($callWebhookData);
                }
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
