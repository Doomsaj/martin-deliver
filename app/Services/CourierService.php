<?php

namespace App\Services;

use App\Contract\ICourierService;
use App\Enums\ConsignmentStatus;
use App\Enums\WebhookTriggerEvents;
use App\Events\ConsignmentStatusChanged;
use App\Events\CourierLocationChangedEvent;
use App\Exceptions\AccessDeniedException;
use App\Exceptions\ConsignmentAlreadyAcceptedException;
use App\Exceptions\InternalServerException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\ConsignmentStatusChangedData;
use App\Http\Requests\CourierAcceptConsignment;
use App\Http\Requests\CourierConsignmentArrived;
use App\Http\Requests\CourierConsignmentReceived;
use App\Http\Requests\CourierLocationChangedData;
use App\Http\Requests\CourierLocationChangedRequest;
use App\Models\Consignment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Log;

class CourierService implements ICourierService
{
    function getAvailableConsignments(): array
    {
        return Consignment::where(["status" => ConsignmentStatus::PENDING])->get()->toArray();
    }

    function getMyConsignments(): array
    {
        return Consignment::where(["courier_id" => auth()->user()->id])->get()->toArray();
    }

    /**
     * @throws ConsignmentAlreadyAcceptedException
     * @throws InternalServerException
     * @throws NotFoundException
     */
    function acceptConsignment(CourierAcceptConsignment $request): array
    {
        $data = $request->validated();
        $consignmentCode = $data['consignment_code'];
        $lockKey = "consignment_request_lock_$consignmentCode";
        $courierId = auth()->user()->id;

        if (!Consignment::where(["code" => $consignmentCode])->exists()) throw new NotFoundException();

        if (Redis::set($lockKey, $consignmentCode, 'NX', 'EX', 10)) {
            try {
                DB::transaction(function () use ($consignmentCode, $courierId) {
                    $affectedRows = Consignment::where('code', $consignmentCode)
                        ->where('status', ConsignmentStatus::PENDING)
                        ->update([
                            "status" => ConsignmentStatus::ACCEPTED,
                            "courier_id" => $courierId,
                            "updated_at" => now(),
                        ]);

                    if (!$affectedRows) throw new ConsignmentAlreadyAcceptedException();

                    $changeData = new ConsignmentStatusChangedData($consignmentCode,
                        ConsignmentStatus::PENDING,
                        ConsignmentStatus::ACCEPTED,
                        now());

                    ConsignmentStatusChanged::dispatch($changeData);
                });

                return ['status' => 'success', 'message' => 'Request accepted'];
            } catch (ConsignmentAlreadyAcceptedException $e) {
                throw $e;
            } catch (Exception $e) {
                Log::error($e->getMessage(), $e->getTrace());
                throw new InternalServerException();
            } finally {
                Redis::del($lockKey);
            }
        } else {
            throw new ConsignmentAlreadyAcceptedException();
        }
    }

    function consignmentReceived(CourierConsignmentReceived $request)
    {
        // TODO: Implement consignmentReceived() method.
    }

    function consignmentArrived(CourierConsignmentArrived $request)
    {
        // TODO: Implement consignmentArrived() method.
    }

    /**
     * @throws NotFoundException
     * @throws AccessDeniedException
     */
    function courierLocationChanged(CourierLocationChangedRequest $request): void
    {
        $data = $request->validated();

        $consignment = Consignment::with(["client", "client.webhookSubscriptions"])->where("code", "=", $data["consignment_code"])->first();

        if (!$consignment) throw new NotFoundException();
        if ($consignment->courier_id != auth()->user()->id) throw new AccessDeniedException();

        $consignmentClient = $consignment->client;
        $clientWebhook = $consignmentClient->webhookSubscriptions
            ->where("event", "=", WebhookTriggerEvents::COURIER_LOCATION_CHANGED)
            ->first();

        $locationChangedData = new CourierLocationChangedData(
            $data["latitude"],
            $data["longitude"],
            $data["consignment_code"],
            $consignment->id,
            auth()->user()->id);

        CourierLocationChangedEvent::dispatch($locationChangedData, $clientWebhook);
    }
}
