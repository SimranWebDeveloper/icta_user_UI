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
use Carbon\Carbon;

class EmployeeBronsController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->subHours(4);
        $meetings = Meetings::with('rooms')->where('status', 1)->where('type', 2)->get();

        foreach ($meetings as $meeting) {
            $startDateTime = Carbon::parse($meeting->start_date_time)->subHours(4);
            $duration = $meeting->duration;
            $endDateTime = $startDateTime->copy()->addMinutes($duration);

            if ($endDateTime->lessThanOrEqualTo($now)) {
                $meeting->update(['status' => 0]);
            }
        }

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
    $startDateTime = Carbon::parse($data['start_date_time']);
    $endDateTime = $startDateTime->copy()->addMinutes($data['duration']);
    $roomId = $data['rooms_id'];
    $userIds = $request->input('w_user_id', []);

    // Helper function to check time overlap
    $checkTimeOverlap = function ($query) use ($startDateTime, $endDateTime) {
        $query->whereBetween('start_date_time', [$startDateTime, $endDateTime])
            ->orWhereRaw('DATE_ADD(start_date_time, INTERVAL duration MINUTE) BETWEEN ? AND ?', [$startDateTime, $endDateTime])
            ->orWhere(function ($subQuery) use ($startDateTime, $endDateTime) {
                $subQuery->where('start_date_time', '<', $startDateTime)
                    ->whereRaw('DATE_ADD(start_date_time, INTERVAL duration MINUTE) > ?', [$endDateTime]);
            });
    };

    // Check if the meeting overlaps with existing meetings in the selected room
    if (Meetings::where('rooms_id', $roomId)->where('status', 1)
        ->where($checkTimeOverlap)
        ->exists()) 
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Seçilmiş otaq artıq seçilmiş vaxt üçün bron edilib.'
        ]);
    }

    // Check if any selected users are participating in meetings in other rooms during the given time
    $conflictingUsers = MeetingsUsers::join('meetings', 'meetings.id', '=', 'meetings_users.meetings_id')
        ->where('meetings.status', 1)
        ->where('meetings.rooms_id', '<>', $roomId)
        ->where($checkTimeOverlap)
        ->whereIn('meetings_users.users_id', $userIds)
        ->pluck('meetings_users.users_id')
        ->toArray();

    // Get the names of conflicting users
    $conflictingUserNames = User::whereIn('id', $conflictingUsers)->pluck('name')->toArray();

    // If any user is already booked, return an error
    if (count(array_diff($userIds, $conflictingUsers)) < count($userIds)) {
        $conflictingUserNamesList = implode(', ', $conflictingUserNames);
        return response()->json([
            'status' => 'error',
            'message' => "Seçilmiş vaxtda digər görüşdə iştirak edən istifadəçilər: $conflictingUserNamesList."
        ]);
    }

    // Create the new meeting
    $meeting = Meetings::create($data);

    // Attach users to the meeting
    foreach ($userIds as $userId) {
        MeetingsUsers::updateOrCreate([
            'meetings_id' => $meeting->id,
            'users_id' => $userId,
        ]);
    }

    $text = $request->input('type') == 0 ? 'Görüş uğurla yaradıldı' : 'Tədbir uğurla yaradıldı';
    return redirect()->route('hr.meetings.index')->with('success', $text);
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
        $users = User::all();
        $rooms = Rooms::all();

        $meeting_users = MeetingsUsers::where('meetings_id', $meeting->id)->pluck('users_id')->toArray();
        $user_departments = User::whereIn('id', $meeting_users)->pluck('departments_id')->toArray();
        $user_branches = User::whereIn('id', $meeting_users)->pluck('branches_id')->toArray();

        return view('employee.brons.edit', compact('meeting', 'departments', 'branches', 'users', 'user_departments', 'user_branches', 'meeting_users', 'rooms'));

    }


    public function update(Request $request, string $id)
    {

        $meeting = Meetings::findOrFail($id);
        $data = $request->all();
        $startDateTime = Carbon::parse($data['start_date_time']);
        $duration = $data['duration'];
        $endDateTime = $startDateTime->copy()->addMinutes($duration);
        $roomId = $data['rooms_id'];
      
            $overlappingMeeting = Meetings::where('rooms_id', $roomId)
                ->where('status', 1)
                ->where('id', '!=', $id)
                ->where(function ($query) use ($startDateTime, $endDateTime) {
                    $query->where(function ($subQuery) use ($startDateTime, $endDateTime) {
                        $subQuery->where('start_date_time', '<', $endDateTime)
                            ->whereRaw('DATE_ADD(start_date_time, INTERVAL duration MINUTE) > ?', [$startDateTime]);
                    });
                })
                ->exists();

            if ($overlappingMeeting) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Seçilmiş otaq artıq seçilmiş vaxt üçün bron edilib.'
                ]);
            }
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
        try {
            $meeting = Meetings::findOrFail($id);
            $text = 'Bron məlumatları müvəffəqiyyətlə silindi';
            $meeting->delete();

            return response()->json([
                'status' => 'success',
                'message' => $text,
                'route' => route('employee.brons.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Melumat silinərkən bir xəta baş verdi: ' . $e->getMessage()
            ]);
        }

    }
}
