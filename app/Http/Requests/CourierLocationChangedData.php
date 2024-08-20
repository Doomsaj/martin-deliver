<?php

namespace App\Http\Requests;

class CourierLocationChangedData
{
    public function __construct(public float $latitude, public float $longitude, public string $consignmentCode, public int $consignmentId, public int $courierId)
    {
    }
}
