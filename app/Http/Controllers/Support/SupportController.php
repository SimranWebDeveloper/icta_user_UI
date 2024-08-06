<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        return view('support.home');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('support.profile', compact('user'));
    }

    public function update_profile (Request $request, $id)
    {
        $data = $request->all();

        $user = User::find($id);
        if ($request->password) {
            if (bcrypt($request->new_password) == $user->password) {
                return redirect()->route('support.profile')
                    ->with('error', 'Daxil etdiyiniz yeni şifrə mövcud şifrə ilə eynidir!');
            } elseif (bcrypt($request->password) != $user->password) {
                return redirect()->route('support.profile')
                    ->with('error', 'Mövcud şifrəni düzgün daxil etməmisiniz!');
            } else {
                $data['password'] = bcrypt($request->new_password);
            }
            $user->password = $data['password'];
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('support.profile')
            ->with('success', 'Məlumatlar müvəffəqiyyətlə dəyişdirildi.');
    }
}
