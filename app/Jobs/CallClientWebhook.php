<?php

namespace App\Jobs;

use App\Http\Requests\CallWebhookData;
use App\Models\WebhookCallHistory;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Log;

class CallClientWebhook implements ShouldQueue
{
    use Queueable, InteractsWithQueue, Dispatchable;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'webhook-calls';

    /**
     * Create a new job instance.
     */
    public function __construct(protected CallWebhookData $data)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $headers = ["Authorization" => $this->data->secret];
            $request = Http::withHeaders($headers)->post($this->data->url, $this->data->data);
            $response = $request->json();
            WebhookCallHistory::create([
                "url" => $this->data->url,
                "response" => json_encode($response),
                "payload" => json_encode($this->data->data),
                "headers" => json_encode($headers),
                "status_code" => $request->status(),
                "has_error" => false
            ]);
        } catch (Exception $e) {
            WebhookCallHistory::create([
                "url" => $this->data->url,
                "payload" => json_encode($this->data->data),
                "headers" => json_encode($headers),
                "has_error" => true,
                "error_message" => $e->getMessage()
            ]);
            Log::error($e->getMessage());
        }
    }
}
