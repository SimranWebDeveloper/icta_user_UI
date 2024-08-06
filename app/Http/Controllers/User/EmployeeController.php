<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        //elanlar
        //anketler where expired_at > now()
        //iclas tedbirler

        // iclas tedbir - accept reject
        //  ankete cavab
        return view('employee.home');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('employee.profile', compact('user'));
    }

    public function update_profile (Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if ($request->filled('password')) {
            if (Hash::check($request->new_password, $user->password)) {
                return redirect()->route('employee.profile')
                    ->with('error', 'Daxil etdiyiniz yeni şifrə mövcud şifrə ilə eynidir!');
            } elseif (!Hash::check($request->password, $user->password)) {
                return redirect()->route('employee.profile')
                    ->with('error', 'Mövcud şifrəni düzgün daxil etməmisiniz!');
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();
            }
        }
        $user->name = $request->name;
        $user->b_day = $request->b_day;
        $user->email = $request->email;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('assets/images/avatars', $filename);
            $user->avatar = $filename;
        }
        $user->save();

        return redirect()->route('employee.profile')
            ->with('success', 'Məlumatlar müvəffəqiyyətlə dəyişdirildi.');
    }
}
