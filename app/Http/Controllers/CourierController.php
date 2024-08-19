<?php

namespace App\Http\Controllers;

use App\Contract\ICourierService;

class CourierController extends Controller
{
    public function __construct(protected ICourierService $courierService)
    {
    }

    public function getAvailableConsignments()
    {
        return response()->json(["data" => $this->courierService->getAvailableConsignments()]);
    }
}
