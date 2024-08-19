<?php

namespace App\Services;

use App\Contract\IClientRequestService;
use App\Enums\ConsignmentStatus;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\CancelConsignmetRequest;
use App\Http\Requests\PlaceNewConsignmentRequest;
use App\Models\Consignment;
use function auth;

class ClientRequestService implements IClientRequestService
{
    function placeNewRequest(PlaceNewConsignmentRequest $request): string
    {
        $data = $request->validated();

        $consignment = Consignment::create([
            "status" => ConsignmentStatus::PENDING,
            "starting_latitude" => $data["receive_from"]["latitude"],
            "starting_longitude" => $data["receive_from"]["longitude"],
            "sender_address" => $data["receive_from"]["address"],
            "sender_name" => $data["receive_from"]["name"],
            "sender_phone" => $data["receive_from"]["phone"],
            "destination_latitude" => $data["delivery_to"]["latitude"],
            "destination_longitude" => $data["delivery_to"]["longitude"],
            "recipient_address" => $data["delivery_to"]["address"],
            "recipient_name" => $data["delivery_to"]["name"],
            "recipient_phone" => $data["delivery_to"]["phone"],
            "client_id" => auth()->user()->id
        ]);

        return $consignment->code;
    }

    /**
     * @throws NotFoundException|AccessDeniedException|BadRequestException
     */
    function cancelRequest(CancelConsignmetRequest $request): array
    {
        $data = $request->validated();

        $consignment = Consignment::where("code", $data["consignment_code"])->first();

        if (!$consignment) throw new NotFoundException();

        if (auth()->user()->id !== $consignment->client_id) throw new AccessDeniedException();

        if ($consignment->status == ConsignmentStatus::PENDING) {
            $consignment->update(["status" => ConsignmentStatus::CANCELLED]);

            return ["consignment_code" => $consignment->code, "canceled" => true];
        } else {
            throw new BadRequestException("The request cannot be canceled");
        }
    }
}
