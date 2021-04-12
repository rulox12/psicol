<?php

namespace App\Http\Controllers;

use App\Domain\Tickets\CreateOrUpdateTicketAction;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\BuyerResource;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class TicketController extends BaseController
{
    public function all(): JsonResponse
    {
        $buyers = Ticket::forAvailable()->paginate();

        return $this->successResponse(TicketResource::collection($buyers));
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $ticket = CreateOrUpdateTicketAction::execute($request, new Ticket());

        return $this->successResponse(new TicketResource($ticket));
    }
}
