<?php

namespace App\Contract;

use App\Http\Requests\CourierAcceptConsignment;
use App\Http\Requests\CourierConsignmentArrived;
use App\Http\Requests\CourierConsignmentReceived;
use App\Http\Requests\CourierLocationChangedRequest;

interface ICourierService
{
    function getAvailableConsignments();

    function getMyConsignments();

    function acceptConsignment(CourierAcceptConsignment $request);

    function consignmentReceived(CourierConsignmentReceived $request);

    function consignmentArrived(CourierConsignmentArrived $request);

    function courierLocationChanged(CourierLocationChangedRequest $request);
}
