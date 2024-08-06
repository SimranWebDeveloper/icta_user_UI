<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
