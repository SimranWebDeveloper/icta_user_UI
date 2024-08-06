<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\GeneralSettings;
use App\Models\Positions;
use App\Models\TicketReasons;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $item = GeneralSettings::first();
        $departments = Departments::withCount('branches')->withCount('users')->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users = User::where('type', 'employee')->get();
        $all_users = User::all();
        $assets_requests_users_id = User::whereNotNull('assets_requests_id')->pluck('id')->toArray();
        $reasons = TicketReasons::withCount('tickets')->get();
        $roles = Role::withCount('permissions')->withCount('users')->get();
        $permissions = Permission::all();
        $technical_users = User::where('type', '!=', 'employee')->get();
        $report_receiver_positions = Positions::with('departments', 'users')->where('report_receiver', 1)->get();
        return view(
            'admin.general-settings.index',
            compact(
                'item',
                'departments',
                'branches',
                'users',
                'all_users',
                'reasons',
                'roles',
                'permissions',
                'technical_users',
                'report_receiver_positions',
                'assets_requests_users_id'
            )
        );
    }

    public function update_general_settings(Request $request)
    {


        $report_data = [
            'departments' => [],
            'branches' => [],
            'users' => []
        ];
        if (!is_null($request->w_user_id)) {
            foreach ($request->w_user_id as $user_id) {
                $user = User::find($user_id);
                $departments_id = !is_null($user->departments) ? $user->departments->id : NULL;
                $branches_id = !is_null($user->branches) ? $user->branches->id : NULL;

                if (!in_array($departments_id, $report_data['departments'])) {
                    $report_data['departments'][] = $departments_id;
                }

                if (!in_array($branches_id, $report_data['branches'])) {
                    $report_data['branches'][] = $branches_id;
                }

                $report_data['users'][] = $user_id;
            }
        }

        $settings = GeneralSettings::first();

        if($settings->notification_content && $settings->notification_content != $request->notification_content){
            $user = User::all();
            foreach ($user as $user) {
                $user->read_notf = 0;
                $user->save();
            }
        }


        $general_settings = GeneralSettings::updateOrCreate(
            ['id' => 1],
            [
                'welcome_message' => $request->welcome_message ?? NULL,
                'repair_mode' => isset($request->repair_mode) && $request->repair_mode == "on" ? 1 : 0,
                'repair_mode_message' => $request->repair_mode_message ?? NULL,
                'weekly_report_module' => isset($request->weekly_report_module) && $request->weekly_report_module == "on" ? 1 : 0,
                'weekly_report_module_users' => isset($request->weekly_report_module) && $request->weekly_report_module == "on" ? json_encode($report_data) : json_encode([]),
                'ticket_module' => isset($request->ticket_module) && $request->ticket_module == "on" ? 1 : 0,
                'assets_requests' => isset($request->assets_requests) && $request->assets_requests == "on" ? 1 : 0,
                'delivery_act_generation' => isset($request->delivery_act_generation) && $request->delivery_act_generation == "on" ? 1 : 0,
                'delivery_act_content' => $request->delivery_act_content ?? NULL,
                'delivery_to_another_employee_act_generation' => isset($request->delivery_to_another_employee_act_generation) && $request->delivery_to_another_employee_act_generation == "on" ? 1 : 0,
                'delivery_to_another_employee_act_content' => $request->delivery_to_another_employee_act_content ?? NULL,
                'notification_module' => isset($request->notification_module) && $request->notification_module == "on" ? 1 : 0,
                'notification_content' => $request->notification_content ?? NULL,
                'hr_blog_module' => isset($request->hr_blog_module) && $request->hr_blog_module == "on" ? 1 : 0
            ]
        );

        if ($request->assets_requests_confirm) {
            foreach ($request->assets_requests_confirm as $confirm_key => $confirm) {
                $user = User::find($confirm);
                $user->assets_requests_id = $request->assets_requests_confirm_order[$confirm_key];
                $user->save();
            }
        }

        return redirect()->back()->with('success', 'Məlumatlar dəyişdirildi');

    }



    public function store_ticket_reasons(Request $request)
    {
        TicketReasons::create([
            'reason' => $request->reason,
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Məlumatlar əlavə edildi');
    }

    public function store_technical_users(Request $request)
    {
        $user = User::find($request->user_id);
        $user->role = Role::find($request->role)->name;
        $user->type = $user->type.','.$request->type;
        $user->save();

        $role = Role::find($request->role);
        $user->assignRole($role);
        return redirect()->back()->with('success', 'Məlumatlar əlavə edildi');
    }

    public function store_roles(Request $request)
    {
        $role = Role::create([
            'name' => $request->role_name,
            'guard' => 'web'
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('success', 'Məlumatlar əlavə edildi');
    }

    public function store_permissions(Request $request)
    {
        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => 'web'
        ]);
        return redirect()->back()->with('success', 'Məlumatlar əlavə edildi');
    }
}
