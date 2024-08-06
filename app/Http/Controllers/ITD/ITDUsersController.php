<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Departments;
use App\Models\Positions;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;

class ITDUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with([
            'departments' => function ($query) {
                $query->withTrashed();
            },
            'branches' => function ($query) {
                $query->withTrashed();
            },
            'positions' => function ($query) {
                $query->withTrashed();
            },
            'rooms' => function ($query) {
                $query->withTrashed();
            }
        ])->get();
        return view('itd-leader.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::where('status', 1)->get();
        $branches = Branches::where('status', 1)->get();
        $management_board = Positions::where('departments_id', NULL)->where('branches_id', NULL)->get();
        $positions = Positions::where('status', 1)->whereNot('departments_id', NULL)->get();
        $rooms = Rooms::where('status', 1)->get();

        return view('itd-leader.users.create', compact('departments', 'branches', 'rooms', 'positions', 'management_board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['branches_id'] = $request->branches_id === "NULL" ? NULL : $request->branches_id;
        $data['password'] = bcrypt($request->email);
        User::create($data);

        return redirect()->route('itd-leader.users.index')->with('success', 'Məlumatlar əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('itd-leader.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Departments::where('status', 1)->get();
        $branches = Branches::where('status', 1)->get();
        $rooms = Rooms::where('status', 1)->get();
        $management_board = Positions::where('departments_id', NULL)->where('branches_id', NULL)->get();
        $positions = Positions::where('status', 1)->whereNot('departments_id', NULL)->get();

        $user = User::findOrFail($id);
        return view('itd-leader.users.edit', compact('user', 'departments', 'branches', 'rooms', 'positions', 'management_board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if (!is_null($data['password'])) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);

        return redirect()->route('itd-leader.users.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return response()->json([
            'message' => 'Məlumatlar müvəffəqiyyətlə silind',
            'route' => route('itd-leader.users.index')
        ]);
    }

    public function update_user_report_receiver_data(Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        $user->report_receiver_id = $data['report_receiver_id'];
        $user->save();

        $user_receiver = User::find($data['report_receiver_id']);

        return response()->json([
            'message' => $user->positions->name . ' vəzifəsində çalışan ' . $user->name . ' üçün hesabatları qəbul edən ' . $user_receiver->positions->name . ' vəzifəsində çalışan ' . $user_receiver->name . ' təyin edildi',
            'icon' => 'success',
            'status' => 200
        ]);
    }
}
