<?php

namespace App\Http\Controllers;

use App\Contract\ICourierService;
use App\Http\Requests\CourierAcceptConsignment;
use App\Http\Requests\CourierConsignmentArrived;
use App\Http\Requests\CourierConsignmentReceived;
use App\Http\Requests\CourierLocationChangedRequest;

class CourierController extends Controller
{
    public function __construct(protected ICourierService $courierService)
    {
    }

    public function getAvailableConsignments()
    {
        return response()->json(["data" => $this->courierService->getAvailableConsignments()]);
    }

    public function acceptConsignment(CourierAcceptConsignment $request)
    {
        return response()->json($this->courierService->acceptConsignment($request));
    }

    public function updateCourierLocation(CourierLocationChangedRequest $request)
    {
        $this->courierService->courierLocationChanged($request);
        return response()->json(["updated" => true]);
    }

    public function getMyConsignments()
    {
        return response()->json(["data" => $this->courierService->getMyConsignments()]);
    }

    public function consignmentReceived(CourierConsignmentReceived $request)
    {
        return response()->json($this->courierService->consignmentReceived($request));
    }

    public function consignmentArrived(CourierConsignmentArrived $request)
    {
        return response()->json($this->courierService->consignmentArrived($request));
    }
}
