<?php

namespace App\Http\Controllers;

use App\Contract\ICourierService;
use App\Http\Requests\CourierAcceptConsignment;

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
}
