<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meetings;
use App\Models\MeetingsUsers;
use App\Models\SurveysQuestions;
use App\Models\SurveysUsers;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcements;
use App\Models\Surveys;
use App\Models\UsersAnswers;
use Illuminate\Support\Arr;
use Carbon\Carbon;





class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $announcements = Announcements::where('status', 1)->get();

        $meetings_users = MeetingsUsers::where('users_id', $user->id)->get();
        $meetings_ids = $meetings_users->pluck('meetings_id');
        $meetings = Meetings::whereIn('id', $meetings_ids)->where('status', 1)->with('rooms')->get();


        $surveys_users = SurveysUsers::with('surveys')->where('users_id', $user->id)->get();
        $surveyIds = Arr::flatten($surveys_users->pluck('surveys.id'));
        $surveys = Surveys::whereIn('id', $surveyIds)->where('status', 1)->with('surveys_questions.answers')->get();

        $userAnswers = UsersAnswers::where('users_id', $user->id)
            ->whereIn('surveys_id', $surveyIds)
            ->get()
            ->groupBy('surveys_id')
            ->mapWithKeys(function ($answers, $surveyId) {
                return [$surveyId => $answers->keyBy('surveys_questions_id')];
            });

        return view('employee.home', compact('announcements', 'meetings', 'surveys', 'surveys_users', 'userAnswers', 'meetings_users'));
    }



    public function profile()
    {
        $user = Auth::user();
        return view('employee.profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        // if ($request->filled('password')) {
        //     if (Hash::check($request->new_password, $user->password)) {
        //         return redirect()->route('employee.profile')
        //             ->with('error', 'Daxil etdiyiniz yeni şifrə mövcud şifrə ilə eynidir!');
        //     } elseif (!Hash::check($request->password, $user->password)) {
        //         return redirect()->route('employee.profile')
        //             ->with('error', 'Mövcud şifrəni düzgün daxil etməmisiniz!');
        //     } else {
        //         $user->password = Hash::make($request->new_password);
        //         $user->save();
        //     }
        // }
        $user->name = $request->name;
        $user->b_day = $request->b_day ?? '0000-00-00';
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('assets/images/avatars', $filename);
            $user->avatar = $filename;
        }
        $user->save();

        return redirect()->route('employee.profile')
            ->with('success', 'Məlumatlar müvəffəqiyyətlə dəyişdirildi.');
    }

    public function submitSurvey(Request $request)
    {

        $userId = auth()->user()->id;

        foreach ($request->question as $question_key => $question) {
            if (is_array($question)) {
                foreach ($question as $answer) {
                    $userAnswer = UsersAnswers::create([
                        'users_id' => $userId,
                        'surveys_id' => SurveysQuestions::find($question_key)->surveys->id,
                        'surveys_questions_id' => $question_key,
                        'answer' => $answer,
                    ]);

                    SurveysUsers::where('surveys_id', $userAnswer->surveys_id)->where('users_id', $userId)->update([
                        'is_answered' => 1
                    ]);

                }
            } else {
                $userAnswer = UsersAnswers::create([
                    'users_id' => $userId,
                    'surveys_id' => SurveysQuestions::find($question_key)->surveys->id,
                    'surveys_questions_id' => $question_key,
                    'answer' => $question,
                ]);

                SurveysUsers::where('surveys_id', $userAnswer->surveys_id)->where('users_id', $userId)->update([
                    'is_answered' => 1
                ]);
            }

        }

        return redirect()->route('employee.home')->with('success', 'Anket müvəffəqiyyətlə cavablandırıldı');
    }

    public function updateParticipationStatus(Request $request)
    {
        $userId = Auth::id();
        $meetingId = $request->meeting_id;
        $participationStatus = $request->participation_status;
        $reason = $request->reason;

        $meetingUser = MeetingsUsers::where('users_id', $userId)
            ->where('meetings_id', $meetingId)
            ->first();

        if ($meetingUser) {
            if ($participationStatus == 1) {
                $meeting = Meetings::find($meetingId);
                $startDateTime = Carbon::parse($meeting->start_date_time);
                $endDateTime = $startDateTime->copy()->addMinutes($meeting->duration);

                $conflictingMeetings = MeetingsUsers::join('meetings', 'meetings.id', '=', 'meetings_users.meetings_id')
                    ->where('meetings_users.users_id', $userId)
                    ->where('meetings.id', '<>', $meetingId)
                    ->where('meetings.rooms_id', '<>', $meeting->rooms_id)
                    ->where('meetings.status', 1)
                    ->where('meetings_users.participation_status', 1)
                    ->where(function ($query) use ($startDateTime, $endDateTime) {
                        $query->whereBetween('meetings.start_date_time', [$startDateTime, $endDateTime])
                            ->orWhereRaw('DATE_ADD(meetings.start_date_time, INTERVAL meetings.duration MINUTE) BETWEEN ? AND ?', [$startDateTime, $endDateTime])
                            ->orWhere(function ($subQuery) use ($startDateTime, $endDateTime) {
                                $subQuery->where('meetings.start_date_time', '<', $startDateTime)
                                    ->whereRaw('DATE_ADD(meetings.start_date_time, INTERVAL meetings.duration MINUTE) > ?', [$endDateTime]);
                            });
                    })
                    ->exists();

                if ($conflictingMeetings) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Siz bu vaxtda başqa bir otaqda görüşdə iştirak edirsiniz.'
                    ]);
                }
            }

            $meetingUser->participation_status = $participationStatus;
            $meetingUser->reason = $reason;
            $meetingUser->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }




    public function getUserAnswers($surveyId)
    {
        $userId = Auth::id();

        $answers = UsersAnswers::where('users_id', $userId)
            ->where('surveys_id', $surveyId)
            ->get()
            ->groupBy('surveys_questions_id');

        $formattedAnswers = $answers->map(function ($answersGroup) {
            return $answersGroup->map(function ($answer) {
                return [
                    'answer' => $answer->answer,
                ];
            });
        });

        return response()->json($formattedAnswers);
    }

    public function getUserAnswersByHR($surveyId, $userId)
    {
        $answers = UsersAnswers::where('users_id', $userId)
            ->where('surveys_id', $surveyId)
            ->get()
            ->groupBy('surveys_questions_id');

        $formattedAnswers = $answers->map(function ($answersGroup) {
            return $answersGroup->map(function ($answer) {
                return [
                    'answer' => $answer->answer,
                ];
            });
        });

        return response()->json($formattedAnswers);
    }



    public function getAnswersDetailsByQuestion($surveyId, $questionId)
    {
        // Получение всех ответов по данному опросу и вопросу
        $allAnswers = UsersAnswers::where('surveys_id', $surveyId)
            ->where('surveys_questions_id', $questionId)
            ->get();
    
        // Группируем ответы по значению ответа
        $answerGroups = $allAnswers->groupBy('answer');
    
        // Получаем уникальные user_ids из всех ответов
        $userIds = $allAnswers->pluck('users_id')->unique();
    
        // Получаем данные о пользователях
        $users = User::whereIn('id', $userIds)->pluck('name', 'id')->toArray();
    
        // Формируем результат
        $result = $answerGroups->map(function ($group, $answer) use ($users) {
            return [
                'answer' => $answer,
                'count' => $group->count(), // Количество пользователей, выбравших данный ответ
                'users' => $group->pluck('users_id')->unique()->map(function ($userId) use ($users) {
                    return $users[$userId] ?? 'Unknown'; // Имя пользователя или 'Unknown', если имя не найдено
                })->values() // Список уникальных имен пользователей, выбравших данный ответ
            ];
        });
    
        return response()->json($result);
    }
    

    




}
