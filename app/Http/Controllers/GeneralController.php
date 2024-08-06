<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function update_user_notf_status(Request $request)
    {
        $user = Auth::user();
        $user->read_notf = 1;
        $user->save();

        return response()->json([
            'status' => true,
            'icon' => 'success',
            'title' => 'Bildiriş!',
            'message' => 'Məlumatla tanış oldunuz!'
        ]);
    }
}
