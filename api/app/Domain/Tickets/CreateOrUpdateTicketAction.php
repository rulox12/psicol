<?php

namespace App\Domain\Tickets;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateTicketAction
{
    public static function execute(Request $request, Ticket $ticket): Ticket
    {
        $ticket->event = $request->input('event');
        $ticket->charge = $request->input('charge');
        $ticket->event_date = $request->input('event_date');
        $ticket->available = $request->input('available');
        $ticket->buyer_id = $request->input('buyer_id');
        $ticket->available = true;
        $ticket->created_by = Auth::user()->id;

        $ticket->save();

        return $ticket;
    }
}
