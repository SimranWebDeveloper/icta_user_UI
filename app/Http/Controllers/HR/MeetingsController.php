<?php

namespace App\Http\Controllers\HR;

use App\Models\Meetings;
use App\Models\Departments;
use App\Models\User;
use App\Models\Branches;
use App\Models\MeetingsUsers;
use App\Models\Rooms;
use Carbon\Carbon;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingsController extends Controller
{

    public function index()
    {
        $now = Carbon::now()->addHours(4);
        $meetings = Meetings::with('rooms')->whereIn('type', [0, 1])->get();

        foreach ($meetings as $meeting) {
            $startDateTime = Carbon::parse($meeting->start_date_time);
            $duration = $meeting->duration;
            $endDateTime = $startDateTime->copy()->addMinutes($duration);

            if ($endDateTime->lessThanOrEqualTo($now)) {
                $meeting->update(['status' => 0]);
            }
        }

        return view('hr.meetings.index', compact('meetings'));
    }

    public function create()
    {

        $departments = Departments::withCount('branches')->withCount('users')->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users = User::all();

        $rooms = Rooms::all();

        return view('hr.meetings.create', compact('departments', 'branches', 'users', 'rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $startDateTime = Carbon::parse($data['start_date_time']);
        $duration = $data['duration'];
        $endDateTime = $startDateTime->copy()->addMinutes($duration);
        $roomId = $data['rooms_id'];

        $overlappingMeeting = Meetings::where('rooms_id', $roomId) ->where('status', 1)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_date_time', [$startDateTime, $endDateTime])
                    ->orWhereRaw('DATE_ADD(start_date_time, INTERVAL duration MINUTE) BETWEEN ? AND ?', [$startDateTime, $endDateTime])
                    ->orWhere(function ($subQuery) use ($startDateTime, $endDateTime) {
                        $subQuery->where('start_date_time', '<', $startDateTime)
                            ->whereRaw('DATE_ADD(start_date_time, INTERVAL duration MINUTE) > ?', [$endDateTime]);
                    });
            })
            ->exists();

        if ($overlappingMeeting) {
            return redirect()->back()->with('error', 'Göstərilən vaxtda bu otaq artıq doludur.');
        }

        $meeting = Meetings::create($data);

        if ($request->has('w_user_id')) {
            foreach ($request->input('w_user_id') as $userId) {
                if (
                    !MeetingsUsers::where('meetings_id', $meeting->id)
                        ->where('users_id', $userId)
                        ->exists()
                ) {
                    MeetingsUsers::create([
                        'meetings_id' => $meeting->id,
                        'users_id' => $userId,
                    ]);
                }
            }
        }

        $text = $request->input('type') == 0 ? 'Görüş uğurla yaradıldı' : 'Tədbir uğurla yaradıldı';
        return redirect()->route('hr.meetings.index')->with('success', $text);
    }







    public function show(string $id)
    {
        $meeting = Meetings::findOrFail($id);

        $participants = MeetingsUsers::where('meetings_id', $meeting->id)
            ->join('users', 'meetings_users.users_id', '=', 'users.id')
            ->select('users.*', 'meetings_users.participation_status', 'meetings_users.reason')
            ->get();
        $departments = Departments::pluck('name', 'id');
        $branches = Branches::pluck('name', 'id');
        return view('hr.meetings.show', compact('meeting', 'participants', 'departments', 'branches'));
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

        return view('hr.meetings.edit', compact('meeting', 'departments', 'branches', 'users', 'user_departments', 'user_branches', 'meeting_users', 'rooms'));
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
            // return redirect()->back()->withErrors('Göstərilən vaxtda bu otaq artıq doludur.');
            return response()->json([
                'status' => 'error',
                'message' => "Göstərilən vaxtda bu otaq artıq doludur."
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

        $text = $data['type'] == 0 ? 'İclas məlumatları müvəffəqiyyətlə dəyişdirildi' : 'Tədbir məlumatları müvəffəqiyyətlə dəyişdirildi';
        return redirect()->route('hr.meetings.index')->with('success', $text);
    }

    public function destroy(string $id)
    {
        try {
            $meeting = Meetings::findOrFail($id);
            $text = $meeting->type == 0 ? 'İclas məlumatları müvəffəqiyyətlə silindi' : 'Tədbir məlumatları müvəffəqiyyətlə silindi';
            $meeting->delete();

            return response()->json([
                'status' => 'success',
                'message' => $text,
                'route' => route('hr.meetings.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Melumat silinərkən bir xəta baş verdi: ' . $e->getMessage()
            ]);
        }
    }

}
