<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Meetings;
use App\Models\MeetingsUsers;
use App\Models\SurveysQuestions;
use App\Models\SurveysUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcements;
use App\Models\Surveys;
use App\Models\UsersAnswers;
use Illuminate\Support\Arr;





class EmployeeController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Retrieve announcements
    $announcements = Announcements::where('status', 1)->get();

    // Retrieve meetings for the user
    $meetings_users = MeetingsUsers::where('users_id', $user->id)->pluck('meetings_id');
    $meetings = Meetings::whereIn('id', $meetings_users)->where('status', 1)->with('rooms')->get();

    // Retrieve surveys and related data
    $surveys_users = SurveysUsers::with('surveys')->where('users_id', $user->id)->get();
    $surveyIds = Arr::flatten($surveys_users->pluck('surveys.id'));
    $surveys = Surveys::whereIn('id', $surveyIds)->where('status', 1)->with('surveys_questions.answers')->get();

    // Retrieve user answers
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

        // Find the existing entry in the meetings_users table
        $meetingUser = MeetingsUsers::where('users_id', $userId)
            ->where('meetings_id', $meetingId)
            ->first();

        if ($meetingUser) {
            // Update the participation status
            $meetingUser->participation_status = $participationStatus;
            $meetingUser->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function getUserAnswers($surveyId)
    {
        $userId = Auth::id();

        // Fetch user answers for the given survey
        $answers = UsersAnswers::where('users_id', $userId)
            ->where('surveys_id', $surveyId)
            ->get()
            ->groupBy('surveys_questions_id');

        $formattedAnswers = $answers->map(function($answersGroup) {
            return $answersGroup->map(function($answer) {
                return [
                    'answer' => $answer->answer, // Adjust based on how you store answers
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

    $formattedAnswers = $answers->map(function($answersGroup) {
        return $answersGroup->map(function($answer) {
            return [
                'answer' => $answer->answer, // Adjust based on how you store answers
            ];
        });
    });

    return response()->json($formattedAnswers);
}


 
}
