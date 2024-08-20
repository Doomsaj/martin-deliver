<?php

namespace App\Http\Requests;

use App\Enums\ConsignmentStatus;
use DateTime;

class ConsignmentStatusChangedData
{
    public function __construct(public string $consignmentCode, public ConsignmentStatus $prevStatus, public ConsignmentStatus $currentStatus, public DateTime $date)
    {
    }
}
