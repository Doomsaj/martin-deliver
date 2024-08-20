<?php

namespace App\Events;

use App\Http\Requests\ConsignmentStatusChangedData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsignmentStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ConsignmentStatusChangedData $data)
    {

    }
}
