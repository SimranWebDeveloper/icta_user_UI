<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meetings;
use App\Models\Departments;
use App\Models\User;
use App\Models\Branches;
use App\Models\MeetingsUsers;
use App\Models\Rooms;

class EmployeeBronsController extends Controller
{
    public function index()
    {
        $meetings = Meetings::with('rooms')
                            ->where('status', 1)
                            ->where('type', 2)
                            ->get();

        foreach ($meetings as $meeting) {
            $meeting->participants = MeetingsUsers::where('meetings_id', $meeting->id)
                                ->join('users', 'meetings_users.users_id', '=', 'users.id')
                                ->select('users.*')
                                ->get();
        }

        $departments = Departments::pluck('name', 'id');
        $branches = Branches::pluck('name', 'id');

        return view('employee.brons.index', compact('meetings', 'departments', 'branches'));
    }
    
    public function create()
    {
        $departments = Departments::withCount('branches')->withCount('users')->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users = User::all();
        $rooms = Rooms::all(); 
        
        return view('employee.brons.create', compact('departments', 'branches', 'users', 'rooms'));

    }
   
    public function store(Request $request)
    {
        $data = $request->all();
        $meeting = Meetings::create($data);

        if ($request->has('w_user_id')) {
            foreach ($request->input('w_user_id') as $userId) {
                if (!MeetingsUsers::where('meetings_id', $meeting->id)
                                ->where('users_id', $userId)
                                ->exists()) {
                    MeetingsUsers::create([
                        'meetings_id' => $meeting->id,
                        'users_id' => $userId,
                    ]);
                }
            }
        }
        $text =  'Bron müvəffəqiyyətlə yaradıldı';
        return redirect()->route('employee.brons.index')->with('success', $text);
    }
   
    public function show(string $id) 
    {
        // $meeting = Meetings::findOrFail($id);

        // $participants = MeetingsUsers::where('meetings_id', $meeting->id)
        // ->join('users', 'meetings_users.users_id', '=', 'users.id')
        // ->select('users.*')
        // ->get();
        // $departments = Departments::pluck('name', 'id');
        // $branches = Branches::pluck('name', 'id');
        //  return view('hr.meetings.show', compact('meeting', 'participants', 'departments', 'branches'));

        return view('employee.brons.show');

    }
    
    public function edit(string $id) 
    {
        $meeting = Meetings::findOrFail($id);
    
        $departments = Departments::withCount(['branches', 'users'])->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users =  User::all();
        $rooms = Rooms::all();
    
        $meeting_users = MeetingsUsers::where('meetings_id', $meeting->id)->pluck('users_id')->toArray();
        $user_departments = User::whereIn('id', $meeting_users) ->pluck('departments_id')->toArray();
        $user_branches = User::whereIn('id', $meeting_users)->pluck('branches_id')->toArray();
    
        return view('employee.brons.edit', compact('meeting', 'departments', 'branches', 'users', 'user_departments', 'user_branches', 'meeting_users', 'rooms'));

    }

    
    public function update(Request $request, string $id) 
    {

        $meeting = Meetings::findOrFail($id);
        $data = $request->all();
        $meeting->update($data);
        MeetingsUsers::where('meetings_id', $meeting->id)->delete();

        if ($request->has('w_user_id')) {
            foreach ($request->input('w_user_id') as $userId) {
                MeetingsUsers::create([
                    'meetings_id' => $meeting->id,
                    'users_id' => $userId,
                ]);
            }
        }
        $text = 'Bron müvəffəqiyyətlə dəyişdirildi';
        return redirect()->route('employee.brons.index')->with('success', $text);

    }

    
    public function destroy(string $id) 
    {
        return view('employee.brons.index');

    }
}
