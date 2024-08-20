<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookCallHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "url",
        "payload",
        "headers",
        "response",
        "status_code",
        "has_error",
        "error_message",
    ];
}
