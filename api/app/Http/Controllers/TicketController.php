<?php

namespace App\Http\Controllers;

use App\Domain\Tickets\CreateOrUpdateTicketAction;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class TicketController extends BaseController
{
    public function all(): JsonResponse
    {
        $tickets = Ticket::forAll()->get();

        return $this->successResponse(TicketResource::collection($tickets));
    }

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $ticket = CreateOrUpdateTicketAction::execute($request, new Ticket());

        return $this->successResponse(new TicketResource($ticket));
    }

    public function toggle($ticketId): JsonResponse
    {
        CreateOrUpdateTicketAction::toggle($ticketId);

        return $this->all();
    }

    public function filterAvailable($available): JsonResponse
    {
        $tickets = Ticket::forAvailable($available)->get();

        return $this->successResponse(TicketResource::collection($tickets));
    }

    public function assignBuyer(string $tickedId, string $buyerId): JsonResponse
    {
        $ticket = CreateOrUpdateTicketAction::assignBuyer($tickedId, $buyerId);

        return $this->successResponse(new TicketResource($ticket));
    }
}
