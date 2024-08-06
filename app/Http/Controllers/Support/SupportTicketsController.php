<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\TicketHistories;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketsController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'like', '%support%')->where('id', '!=', Auth::user()->id)->get();
        $tickets = Tickets::with('user', 'ticket_reasons', 'appointments.products')->get();
        return view('support.tickets.index', compact('tickets', 'users'));
    }

    public function my_tickets()
    {
        $tickets = Auth::user()->my_tickets;

        $total = $tickets->count();
        $pending = $tickets->where('status', 0)->count();
        $solved = $tickets->where('status','!=', 0)->count();

        return view('support.tickets.my-tickets', compact('tickets', 'total', 'pending', 'solved'));
    }

    public function accept_ticket(Request $request)
    {
        $ticket = Tickets::where('ticket_number', $request->ticket_number)->first();
        if ($ticket) {
            $ticket->helpdesk_id = Auth::user()->id;

            if ($ticket->save()) {

                $ticket_history = TicketHistories::create([
                    'tickets_id' => $ticket->id,
                    'subject' => 'Bilet qəbul edildi',
                    'description' => $ticket->user->name.' tərəfindən yaradılan '. $ticket->ticket_number .' nömrəli bilet '. Auth::user()->name .' (Texniki dəstək mütəxəssisi) tərəfindən qəbul edildi.',
                    'class' => 'info',
                ]);

                return response()->json([
                    'notification' => 'Bileti qəbul etdiniz',
                    'route' => route('support.my-tickets'),
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('support.tickets.index'),
                    'status' => 500
                ]);
            }
        } else {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('support.tickets.index'),
                'status' => 404
            ]);
        }
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
                    'description' => $ticket->user->name.' tərəfindən yaradılan '. $ticket->ticket_number .' nömrəli biletə problemin həll olunması üçün '. $ticket->operator->name .' (Texniki dəstək mütəxəssisi) tərəfindən '.$ticket->helpdesk->name .' (Texniki dəstək mütəxəssisi) təyin olundu.',
                    'class' => 'info',
                ]);

                return response()->json([
                    'notification' => 'Bilet təhkim olundu',
                    'route' => route('support.tickets.index'),
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('support.tickets.index'),
                    'status' => 500
                ]);
            }
        } else {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('support.tickets.index'),
                'status' => 404
            ]);
        }
    }


    public function update_ticket(Request $request)
    {
        $ticket = Tickets::where('ticket_number', $request->ticket_number)->first();
        if ($ticket) {
            $ticket->status = $request->ticket_status;

            if($ticket->status == 0) {
                $text = 'Gözləyir';
                $class = 'warning';
            } elseif ($ticket->status == 1) {
                $text = 'Həll olundu';
                $class = 'success';
            } elseif($ticket->status == 2) {
                $text = 'Problem yoxdur - Əsassız';
                $class = 'primary';
            } elseif($ticket->status == 3) {
                $text = 'İnventar sıradan çıxıb';
                $class = 'danger';
            }

            if ($ticket->save()) {

                $ticket_history = TicketHistories::create([
                    'tickets_id' => $ticket->id,
                    'subject' => 'Bilet statusu dəyişdirildi',
                    'description' => $ticket->user->name.' tərəfindən yaradılan '. $ticket->ticket_number .' nömrəli biletin statusu '. $ticket->helpdesk->name .' tərəfindən "'. $text .'" olaraq dəyişdirildi.',
                    'class' => $class,
                ]);

                return response()->json([
                    'notification' => 'Bilet məlumatları dəyişdirildi',
                    'route' => route('support.my-tickets'),
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'notification' => 'Xəta',
                    'route' => route('support.tickets.index'),
                    'status' => 500
                ]);
            }
        } else {
            return response()->json([
                'notification' => 'Bilet tapılmadı',
                'route' => route('support.tickets.index'),
                'status' => 404
            ]);
        }
    }

    public function get_ticket_details (Request $request)
    {
        $ticket = Tickets::with('ticket_histories')->find($request->ticket_id);
        return view('support.tickets.timeline', compact('ticket'));
    }
}
