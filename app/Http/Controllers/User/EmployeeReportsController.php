<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\Models\ReportsSubjects;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receiver = User::where('id', Auth::user()->report_receiver_id)->select('name')->first();
        $completed_reports = Reports::with('reports_subjects')->where('user_id', Auth::user()->id)->whereIn('status',[1, 2])->get();
        $uncompleted_reports = Reports::with('reports_subjects')->where('user_id', Auth::user()->id)->where('status', 0)->first();

        return view('employee.reports.index', compact( 'completed_reports', 'uncompleted_reports', 'receiver'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $report = Reports::create([
            'departments_id' => !is_null(Auth::user()->departments) ? Auth::user()->departments->id : NULL,
            'branches_id' => !is_null(Auth::user()->branches) ? Auth::user()->branches->id : NULL,
            'user_id' => Auth::user()->id,
            'report_date' => Carbon::now()
        ]);

        foreach ($request->subjects as $subject_key => $subject) {
            if (!empty($subject)) {
                ReportsSubjects::create([
                    'reports_id' => $report->id,
                    'project_name' => $request->project_name[$subject_key],
                    'subject' => $subject,
                ]);
            }
        }

        return redirect()->route('employee.reports.index')->with('success', Carbon::now()->format('d.m.Y').' tarixi üçün həftəlik hesabat daxil edildi');


    }

    public function report_list()
    {
        $report_user_list = User::with(['reports' => function($query) {
            $query->where('status', '!=', 0);
        }, 'reports.reports_subjects'])
            ->whereHas('reports', function ($query) {
                $query->where('status', '!=', 0);
            })
            ->where('report_receiver_id', Auth::user()->id)
            ->get();
        return view('employee.reports.report-list', compact('report_user_list'));
    }

    public function update_report_status(Request $request)
    {
        $report = Reports::find($request->report_id);

        $status = $request->type == 'accept' ? 2 : 1;

        $report->status = $status;
        $report->save();

        $message = $request->type == 'accept' ? 'Hesabat təsdiqləndi' : 'Hesabat geri göndərildi';
        return response()->json(
            [
                'route' => route('employee.report-list'),
                'message' => $message,
                'icon' => 'success',
            ], 200);


    }
    public function confirm_reports(Request $request)
    {
        $report = Reports::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if($report)
        {
            $report->reports_subjects()->update(['status' => 1]);
            $report->status = 1;
            $report->report_date = Carbon::now();
            if($report->save())
            {
                return response()->json(
                    [
                        'message' => 'Həftəlik hesabat müvəffəqiyyətlə göndərildi',
                        'icon' => 'success',
                        'route' => route('employee.reports.index'),
                    ], 200);
            } else {
                return response()->json(
                    [
                        'message' => 'Xəta baş verdi',
                        'icon' => 'error',
                    ], 500);
            }

        } else {
            return response()->json(
                [
                    'message' => 'Hesabat tapılmadı',
                    'icon' => 'info',
                ], 404);
        }







    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
