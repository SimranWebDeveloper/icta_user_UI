<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\DB;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {

        $general_settings = GeneralSettings::first();
        $repair_mode = $general_settings->repair_mode;


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = User::find(Auth::user()->id);
            $user->save();

            $user_role_count = explode(',',$user->type);
            if(count($user_role_count) > 1){
                $user_type = $request->selectedRole;
            } else {
                $user_type = $user->type;
            }
            $user_all_types = ['employee', 'warehouseman', 'administrator', 'hr', 'accountant'];

            foreach($user_role_count as $role) {
                $key = array_search($role, $user_all_types);
                if ($key !== false) {
                    unset($user_all_types[$key]);
                }
            }

            if($user_type != 'administrator')
            {
                if ($repair_mode == 1) {
                    $site_under_construction_text = $general_settings->repair_mode_message;
                    Auth::logout();
                    return view('site-under-construction', compact('site_under_construction_text'));
                }
            }

            (new LogController())->create_logs($user->name . ' sistemə giriş etdi.', 'Sistemə giriş');


            if (Auth::check() && $user_type == 'administrator') {
                return redirect()->route('admin.dashboard')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'warehouseman') {
                return redirect()->route('warehouseman.warehouseman')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'employee') {
                return redirect()->route('employee.home')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'support') {
                return redirect()->route('support.home')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'hr') {
                return redirect()->route('hr.home')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'accountant') {
                return redirect()->route('accountant.home')->with('login_success', 'Sistemə daxil oldunuz');
            } elseif (Auth::check() && $user_type == 'itd-leader') {
                return redirect()->route('itd-leader.home')->with('login_success', 'Sistemə daxil oldunuz');
            }
        }
        return redirect()->back()->withInput(request()->only('email'))->with('login_error', 'Daxil etdiyiniz məlumatlar doğru deyil');
    }
    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->save();

        Session::forget('user_current_type');
        (new LogController())->create_logs(Auth::user()->name . ' sistemdən çıxış etdi.', 'Sistemdən çıxış');
        Auth::logout();
        return redirect('/');
    }


    public function checkUserStatus(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user) {
            $roles = explode(',', $user->type);

            if (count($roles) > 1) {
                return response()->json([
                    'status' => 'multiple_roles',
                    'roles' => $roles
                ]);
            } else {
                return response()->json([
                    'status' => 'single_role',
                    'role' => $roles[0]
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Daxil etdiyiniz məlumatlara uyğun istifadəçi tapılmadı..'
            ]);
        }
    }



}
