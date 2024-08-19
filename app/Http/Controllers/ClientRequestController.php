<?php

namespace App\Http\Controllers;

use App\Contract\IClientRequestService;
use App\Http\Requests\CancelConsignmetRequest;
use App\Http\Requests\PlaceNewConsignmentRequest;

class ClientRequestController extends Controller
{
    public function __construct(protected IClientRequestService $clientRequestService)
    {
    }

    public function placeNewConsignmentRequest(PlaceNewConsignmentRequest $request)
    {
        return response()->json(["consignment_code" => $this->clientRequestService->placeNewRequest($request)]);
    }

    public function cancelRequest(CancelConsignmetRequest $request)
    {
        return response()->json(["deleted" => $this->clientRequestService->cancelRequest($request)]);
    }
}
