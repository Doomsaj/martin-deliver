<?php

namespace App\Models;

use App\Enums\WebhookTriggerEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        "url", "method", "secret", "client_id", "event"
    ];

    protected $hidden = [
        "secret",
        "id",
        "client_id"
    ];

    protected function casts(): array
    {
        return [
            "event" => WebhookTriggerEvents::class
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
