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

class SurveysController extends Controller
{
    
    public function index()
    {
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
    // dd($request->all());
    $data = Surveys::create([
        "name" => $request->name,
        "expired_at" => $request->expired_at,
        "status" => $request->status,
        "is_anonym" => $request->is_anonym,
        "priority" => $request->priority,   
        // "target" => NULL    bu prop değişti, tablo oldu
    ]);

    if ($request->has('w_user_id')) {
        foreach ($request->input('w_user_id') as $userId) {
            if (!SurveysUsers::where('surveys_id', $data->id)
                               ->where('users_id', $userId)
                               ->exists()) {
                SurveysUsers::create([
                    'surveys_id' => $data->id,
                    'users_id' => $userId,
                ]);
            }
        }
    }

    foreach ($request->question as $question_key => $test) {
        $questionn = SurveysQuestions::create([
            'surveys_id' => $data->id,
            'question' => $test,
            'input_type' => $request->input_type[$question_key] ?? null 
        ]);

        if (!empty($request->answer_value[$question_key])) { 
            foreach ($request->answer_value[$question_key] as $answer_key => $answer) {
                $answerr = Answers::create([
                    'surveys_questions_id' => $questionn->id,
                    'name' => $answer,
                ]);
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
    ]);

    $questions_id = $survey->surveys_questions()->pluck('id')->toArray();
    
    $answers = Answers::whereIn('surveys_questions_id', $questions_id)->get();
    foreach ($answers as $answer) {
        $answer->delete();
    }

    $survey->surveys_questions()->delete();

    foreach ($request->question as $question_key => $question_text) {
        $newQuestion = SurveysQuestions::create([
            'surveys_id' => $survey->id,
            'question' => $question_text,
            'input_type' => $request->input_type[$question_key] ?? null 
        ]);

        if (!empty($request->answer_value[$question_key])) {
            foreach ($request->answer_value[$question_key] as $answer_text) {
                Answers::create([
                    'surveys_questions_id' => $newQuestion->id,
                    'name' => $answer_text,
                ]);
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
