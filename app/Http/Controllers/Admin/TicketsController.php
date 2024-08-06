<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketHistories;
use App\Models\TicketReasons;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Tickets::all();
        $users = User::where('type', 'like', '%support%')->get();
        return view('admin.tickets.index', compact('tickets','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $support = User::where('type', 'support')->get();
        $users = User::whereHas('appointments')->get();
        $reasons = TicketReasons::where('status', 1)->get();
        return view('admin.tickets.create', compact('users', 'reasons', 'support'));
    }

    public function get_inventories_by_user(Request $request)
    {
        $user = User::find($request->user_id);
        $inventories = $user->inventories()->with('products')->get();
        return $inventories;
    }

    public function assign_ticket(Request $request)
    {
        $ticket = Tickets::where('ticket_number', $request->ticket_number)->first();
        if ($ticket) {
            $ticket->operator_id = Auth::user()->id;
            $ticket->helpdesk_id = $request->user_id;

            if ($ticket->save()) {

                $ticket_history = TicketHistories::create([
                    'tickets_id' => $ticket->id,
                    'subject' => 'Bilet təhkim olundu',
                    'description' => $ticket->user->name.' tərəfindən yaradılan '. $ticket->ticket_number .' nömrəli biletə problemin həll olunması üçün '. Auth::user()->name .' (Administrator) tərəfindən '.$ticket->helpdesk->name .' (Texniki dəstək mütəxəssisi) təyin olundu.',
                    'class' => 'info',
                ]);

                return response()->json([
                    'notification' => 'Bilet təhkim olundu',
                    'route' => route('admin.tickets.index'),
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('admin.tickets.index'),
                    'status' => 500
                ]);
            }
        } else {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('admin.tickets.index'),
                'status' => 404
            ]);
        }
    }

    public function get_ticket_details (Request $request)
    {
        $ticket = Tickets::with('ticket_histories')->find($request->ticket_id);
        return view('admin.tickets.timeline', compact('ticket'));
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

        return redirect()->route('admin.tickets.index')->with('success', 'Texniki dəstək bileti yaradıldı');
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
                    'route' => route('admin.tickets.index'),
                    'status' => 200
                ]);
            }
            else
            {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('admin.tickets.index'),
                    'status' => 500
                ]);
            }
        }
        else
        {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('admin.tickets.index'),
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
        return view('admin.tickets.edit', compact('ticket', 'support', 'reasons', 'users', 'inventories'));
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

            return redirect()->route('admin.tickets.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
