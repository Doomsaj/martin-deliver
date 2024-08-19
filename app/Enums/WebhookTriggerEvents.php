<?php

namespace App\Enums;

enum WebhookTriggerEvents: string
{
    case CONSIGNMENT_CREATED = "consignment_created";
    case CONSIGNMENT_STATUS_CHANGED = "consignment_status_changed";
    case COURIER_LOCATION_CHANGED = "courier_location_changed";
    case CONSIGNMENT_ARRIVAL = "consignment_arrival";
}
