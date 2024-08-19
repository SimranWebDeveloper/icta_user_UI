<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\SurveysQuestions;
use Illuminate\Http\Request;
use App\Models\Surveys;
use App\Models\Departments;
use App\Models\User;
use App\Models\UsersAnswers;
use App\Models\Branches;
use App\Models\SurveysUsers;
use Carbon\Carbon;

class SurveysController extends Controller
{
    
    public function index()
    {
        $now = Carbon::now()->addHours(4); 
        Surveys::where('expired_at', '<', $now->format('Y-m-d H:i:s'))->where('status', '!=', 0)->update(['status' => 0]);
        
        $surveys = Surveys::with('users')->get();
        return view('hr.surveys.index', compact('surveys'));
    }
    

    public function create()
    {
        $departments = Departments::withCount('branches')->withCount('users')->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users = User::all();

        return view('hr.surveys.create', compact('departments', 'branches', 'users'));
    }

    public function store(Request $request)
{
    $survey = Surveys::create([
        "name" => $request->name,
        "expired_at" => $request->expired_at,
        "status" => $request->status,
        "is_anonym" => $request->is_anonym,
        "priority" => $request->priority,
    ]);

    if ($request->has('w_user_id')) {
        foreach ($request->input('w_user_id') as $userId) {
            if (!SurveysUsers::where('surveys_id', $survey->id)
                               ->where('users_id', $userId)
                               ->exists()) {
                SurveysUsers::create([
                    'surveys_id' => $survey->id,
                    'users_id' => $userId,
                ]);
            }
        }
    }

    foreach ($request->question as $question_key => $question_value) {
        $question_text = is_array($question_value) ? $question_value[0] : $question_value;
        $input_type = isset($request->input_type[$question_key]) ? (is_array($request->input_type[$question_key]) ? $request->input_type[$question_key][0] : $request->input_type[$question_key]) : null;

        if (isset($question_text) && !empty($question_text)) {
            $question = SurveysQuestions::create([
                'surveys_id' => $survey->id,
                'question' => $question_text,
                'input_type' => $input_type,
            ]);

            if (!empty($request->answer_value[$question_key])) {
                foreach ($request->answer_value[$question_key] as $answer_text) {
                    if (isset($answer_text) && !empty($answer_text)) {
                        Answers::create([
                            'surveys_questions_id' => $question->id,
                            'name' => $answer_text,
                        ]);
                    }
                }
            }
        }
    }

    return redirect()->route('hr.surveys.index')->with(['success' => 'Anket müvəffəqiyyətlə yaradıldı']);
}


   
public function show(string $id)
{
    $survey = Surveys::with(['surveys_questions.answers'])->findOrFail($id);

    $departments = Departments::pluck('name', 'id');
    $branches = Branches::pluck('name', 'id');

    $users = SurveysUsers::where('surveys_id', $survey->id)
        ->join('users', 'surveys_users.users_id', '=', 'users.id')
        ->select('users.*')
        ->get();

    $is_answered = [];
    foreach ($users as $user) {
        $is_answered[$user->id] = SurveysUsers::where('users_id', $user->id)
            ->where('surveys_id', $survey->id)
            ->value('is_answered');
    }

    $userAnswers = UsersAnswers::where('surveys_id', $survey->id)->get();

    $questionPercentages = [];

    foreach ($survey->surveys_questions as $question) {
        $questionId = $question->id;

        $answersForQuestion = $userAnswers->where('surveys_questions_id', $questionId);

        $answersArray = $answersForQuestion->map(function($answer) {
            return $answer->answer;
        });

        $answerCounts = $answersArray->countBy();

        $totalAnswers = $answersArray->count();

        $percentages = $answerCounts->mapWithKeys(function($count, $answerValue) use ($totalAnswers) {
            $percentage = $totalAnswers > 0 ? ($count / $totalAnswers) * 100 : 0;
            return [$answerValue => $percentage];
        });

        $questionPercentages[$questionId] = [
            'questionText' => $question->text,
            'percentages' => $percentages
        ];
    }

    return view('hr.surveys.show', compact('survey', 'departments', 'branches', 'users', 'is_answered', 'questionPercentages'));
}


    public function edit($id) 
    {
        $data = Surveys::with('surveys_questions.answers')->findOrFail($id);
        $departments = Departments::withCount(['branches', 'users'])->where('status', 1)->get();
        $branches = Branches::withCount('users')->where('status', 1)->get();
        $users = User::all();
    
        $surveys_users = SurveysUsers::where('surveys_id', $data->id)->pluck('users_id')->toArray();
        $user_departments = User::whereIn('id', $surveys_users)->pluck('departments_id') ->toArray();
        $user_branches = User::whereIn('id', $surveys_users)->pluck('branches_id')->toArray();

        return view('hr.surveys.edit', compact('data', 'departments', 'branches', 'users', 'user_departments', 'user_branches', 'surveys_users' )); 
    }

    public function update(Request $request, $id)
    {

        $survey = Surveys::findOrFail($id);

        $survey->update([
            'name' => $request->name,
            'expired_at' => $request->expired_at,
            'status' => $request->status,
            'is_anonym' => $request->is_anonym,
            'priority' => $request->priority,
        ]);

        $ids = $request->ids; // 67, 68, 69
        $current_ids = $survey->surveys_questions()->pluck('id')->toArray(); // 67, 68 

        $insert_ids = array_diff( $ids,$current_ids); 

        
        // 70, 71
        foreach ($insert_ids as $key => $id) {
            $id = intval($id);
            foreach ($request->question[$id] as $question_key => $question_value) {

                $question_text = is_array($question_value) ? $question_value[0] : $question_value;
                $input_type = isset($request->input_type[$id]) ? (is_array($request->input_type[$id]) ? $request->input_type[$id][0] : $request->input_type[$id]) : null;
                if (isset($question_text) && !empty($question_text)) {
                    $question = SurveysQuestions::create([
                        'surveys_id' => $survey->id,
                        'question' => $question_text,
                        'input_type' => $input_type,
                    ]);
    
                    if (!empty($request->answer_value[$id])) {
                        foreach ($request->answer_value[$id] as $answer_text) {
                            if (isset($answer_text) && !empty($answer_text)) {
                                Answers::create([
                                    'surveys_questions_id' => $question->id,
                                    'name' => $answer_text,
                                ]);
                            }
                        }
                    }
                }
            }
        }

        $delete_ids = array_diff( $current_ids, $ids); 



        $answers = Answers::whereIn('surveys_questions_id', $delete_ids)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }

        $survey->surveys_questions()->whereIn('id', $delete_ids)->delete();


        SurveysUsers::where('surveys_id', $survey->id)->delete();

            foreach ($request->w_user_id as $userId) {
                SurveysUsers::create([
                    'surveys_id' => $survey->id,
                    'users_id' => $userId,
                    'is_answered' => 2, 
                ]);
            }

        return redirect()->route('hr.surveys.index')->with('success', 'Anket müvəffəqiyyətlə yeniləndi');
    }


    public function destroy($id) 
    {
        try {
            $survey = Surveys::findOrFail($id);
            $text = 'Anket məlumatları müvəffəqiyyətlə silindi';
            $survey->delete();

            return response()->json([
                'status' => 'success',
                'message' => $text,
                'route' => route('hr.surveys.index')
            ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Melumat silinərkən bir xəta baş verdi: ' . $e->getMessage()
                ]);
            }
    }
}
