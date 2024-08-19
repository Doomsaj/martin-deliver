<?php

namespace App\Contract;

use App\Http\Requests\CancelConsignmetRequest;
use App\Http\Requests\PlaceNewConsignmentRequest;

interface IClientRequestService
{
    function placeNewRequest(PlaceNewConsignmentRequest $request);

    function cancelRequest(CancelConsignmetRequest $request);
}
