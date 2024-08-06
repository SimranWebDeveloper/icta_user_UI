<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TicketHistories;
use App\Models\TicketReasons;
use App\Models\Tickets;
use Auth;
use Illuminate\Http\Request;

class EmployeeTicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets;
        return view('employee.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $appointments = Auth::user()->appointments ?? [];
        $reasons = TicketReasons::where('status', 1)->get();
        return view('employee.tickets.create', compact('reasons', 'appointments'));
    }

    public function store(Request $request)
    {
        $ticket = Tickets::create([
            'user_id' => Auth::user()->id,
            'operator_id' => NULL,
            'helpdesk_id' => NULL,
            'ticket_reasons_id' => $request->ticket_reasons_id,
            'appointments_id' => $request->inventories_id,
            'ticket_number' => '#TICKET-NO-' . rand(0, 999999),
            'status' => 0,
            'rate' => 0,
            'note' => $request->note,
        ]);

        $ticket_history = TicketHistories::create([
            'tickets_id' => $ticket->id,
            'subject' => 'Yeni bilet yaradıldı',
            'description' => Auth::user()->name . ' tərəfindən ' . $ticket->ticket_number . ' nömrəli texniki dəstək bileti yaradıldı.',
            'class' => 'success',

        ]);

        return redirect()->route('employee.tickets.index')->with('success', 'Texniki dəstək bileti yaradıldı');
    }

    public function update_ticket(Request $request)
    {
        $ticket = Tickets::where('ticket_number', $request->ticket_number)->first();
        if ($ticket) {

            if($request->ticket_rating == "NULL")
            {
                $ticket->delete();

                return response()->json([
                    'notification' => 'Bilet müvəffəqiyyətlə silindi',
                    'route' => route('employee.tickets.index'),
                    'status' => 200
                ]);
            } else {
                $ticket->ticket_status = 1;
                $ticket->rate = $request->ticket_rating;

                if ($ticket->save()) {


                    $ticket_history = TicketHistories::create([
                        'tickets_id' => $ticket->id,
                        'subject' => 'Bilet statusu dəyişdirildi',
                        'description' => Auth::user()->name.' tərəfindən '. $ticket->ticket_number .' nömrəli bilet '. $ticket->rate .' qiymətləndirilmə ilə bağlandı.',
                        'class' => 'success',
                    ]);

                    return response()->json([
                        'notification' => 'Bilet məlumatları dəyişdirildi',
                        'route' => route('employee.tickets.index'),
                        'status' => 200
                    ]);
                } else {
                    return response()->json([
                        'notification' => 'Xəta',
                        'route' => route('employee.tickets.index'),
                        'status' => 500
                    ]);
                }
            }

        } else {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('employee.tickets.index'),
                'status' => 404
            ]);
        }
    }
}
