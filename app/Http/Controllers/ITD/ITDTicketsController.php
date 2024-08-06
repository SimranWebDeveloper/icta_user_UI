<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use App\Models\TicketReasons;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;

class ITDTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Tickets::all();
        return view('itd-leader.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $support = User::where('type', 'support')->get();
        $users = User::whereHas('appointments')->get();
        $reasons = TicketReasons::where('status', 1)->get();
        return view('itd-leader.tickets.create', compact('users', 'reasons', 'support'));
    }

    public function get_inventories_by_user(Request $request)
    {
        $user = User::find($request->user_id);
        $inventories = $user->inventories()->with('products')->get();
        return $inventories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tickets::create([
            'user_id' => $request->user_id,
            'helpdesk_id' => $request->helpdesk_id,
            'inventories_id' => $request->inventories_id,
            'ticket_reasons_id' => $request->ticket_reasons_id,
            'ticket_number' => '#TICKET-NO-' . rand(0, 999999),
            'status' => 0,
            'rate' => 0,
            'note' => $request->note
        ]);

        return redirect()->route('itd-leader.tickets.index')->with('success', 'Texniki dəstək bileti yaradıldı');
    }

    public function update_ticket(Request $request)
    {
        $ticket = Tickets::where('ticket_number', $request->ticket_number)->first();
        if($ticket)
        {
            $ticket->ticket_status = 1;
            $ticket->rate = $request->ticket_rating;

            if ($ticket->save()) {
                return response()->json([
                    'notification' => 'Bilet məlumatları dəyişdirildi',
                    'route' => route('itd-leader.tickets.index'),
                    'status' => 200
                ]);
            }
            else
            {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('itd-leader.tickets.index'),
                    'status' => 500
                ]);
            }
        }
        else
        {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('itd-leader.tickets.index'),
                'status' => 404
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Tickets::find($id);
        $support = User::where('type', 'support')->get();
        $users = User::whereHas('appointments')->get();
        $reasons = TicketReasons::where('status', 1)->get();
        $inventories = $ticket->user->inventories;
        return view('itd-leader.tickets.edit', compact('ticket', 'support', 'reasons', 'users', 'inventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Tickets::find($id);

            $ticket->helpdesk_id = $request->helpdesk_id;
            $ticket->ticket_reasons_id = $request->ticket_reasons_id;
            $ticket->status = $request->status;
            $ticket->ticket_status = $request->ticket_status;
            $ticket->rate = $request->rate;
            $ticket->note = $request->note;
            $ticket->save();

            return redirect()->route('itd-leader.tickets.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
