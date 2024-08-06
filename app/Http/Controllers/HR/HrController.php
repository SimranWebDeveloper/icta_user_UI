<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HrController extends Controller
{
    public function index()
    {
        return view("hr.home");
    }

    public function profile()
    {
        $user = Auth::user();
        return view('hr.profile', compact('user'));
    }


    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('succes', 'Məlumatlar dəyişdirildi');
    }

}
