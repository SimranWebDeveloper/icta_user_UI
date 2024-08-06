<?php

namespace App\Http\Controllers\Accountant;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ACCMessageController extends Controller
{

    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        $messages = Message::where('to_user_id', Auth::id())
            ->orWhere('from_user_id', Auth::id())
            ->get();

        return view('accountant.messages.index', compact('users', 'messages'));
    }

    public function sendMessage(Request $request)
    {

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Message Sent!']);
    }

    public function fetchMessages(Request $request)
    {
        $userId = $request->userId;
        $messages = Message::where(function($query) use ($userId) {
            $query->where('to_user_id', Auth::id())
                ->where('from_user_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('from_user_id', Auth::id())
                ->where('to_user_id', $userId);
        })->get();

        return response()->json(['messages' => $messages]);
    }
}
