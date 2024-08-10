<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\SurveysQuestions;
use Illuminate\Http\Request;
use App\Models\Surveys;
use App\Models\Departments;
use App\Models\User;
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
        $survey = Surveys::with([
            'surveys_questions.answers', 
            
        ])->findOrFail($id);
    
        $departments = Departments::pluck('name', 'id');
        $branches = Branches::pluck('name', 'id');

        $users = SurveysUsers::where('surveys_id', $survey->id)
        ->join('users', 'surveys_users.users_id', '=', 'users.id')
        ->select('users.*')
        ->get();
    
        return view('hr.surveys.show', compact('survey', 'departments', 'branches','users'));
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

        return view('hr.surveys.edit', compact('data', 'departments', 'branches', 'users', 'user_departments', 'user_branches', 'surveys_users', )); 
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

    $questions_id = $survey->surveys_questions()->pluck('id')->toArray();
    
    $answers = Answers::whereIn('surveys_questions_id', $questions_id)->get();
    foreach ($answers as $answer) {
        $answer->delete();
    }

    $survey->surveys_questions()->delete();

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

    SurveysUsers::where('surveys_id', $survey->id)->delete();

        foreach ($request->w_user_id as $userId) {
            SurveysUsers::create([
                'surveys_id' => $survey->id,
                'users_id' => $userId,
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
