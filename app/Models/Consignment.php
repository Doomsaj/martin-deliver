<?php

namespace App\Models;

use App\Enums\ConsignmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Consignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "status",
        "starting_latitude",
        "starting_longitude",
        "sender_address",
        "sender_name",
        "sender_phone",
        "destination_latitude",
        "destination_longitude",
        "recipient_address",
        "recipient_name",
        "recipient_phone",
        "client_id",
    ];

    protected $hidden = [
        "client_id",
        "courier_id",
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = (string)Str::uuid7();
        });
    }

    protected function casts(): array
    {
        return [
            'status' => ConsignmentStatus::class,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }
}
