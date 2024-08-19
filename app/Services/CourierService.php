<?php

namespace App\Services;

use App\Contract\ICourierService;
use App\Enums\ConsignmentStatus;
use App\Http\Requests\CourierAcceptConsignment;
use App\Http\Requests\CourierConsignmentArrived;
use App\Http\Requests\CourierConsignmentReceived;
use App\Http\Requests\CourierLocationChanged;
use App\Models\Consignment;

class CourierService implements ICourierService
{
    function getAvailableConsignments(): array
    {
        return Consignment::where(["status" => ConsignmentStatus::PENDING])->get()->toArray();
    }

    function getMyConsignments(): array
    {
        return Consignment::where(["courier_id" => auth()->user()->id])->get();
    }

    function acceptConsignment(CourierAcceptConsignment $request)
    {
        // TODO: Implement acceptConsignment() method.
    }

    function consignmentReceived(CourierConsignmentReceived $request)
    {
        // TODO: Implement consignmentReceived() method.
    }

    function consignmentArrived(CourierConsignmentArrived $request)
    {
        // TODO: Implement consignmentArrived() method.
    }

    function courierLocationChanged(CourierLocationChanged $request)
    {
        // TODO: Implement courierLocationChanged() method.
    }
}
