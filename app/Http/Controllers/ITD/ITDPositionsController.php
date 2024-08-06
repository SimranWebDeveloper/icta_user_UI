<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Positions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ITDPositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Positions::with([
            'departments' => function ($query) {
                $query->withTrashed();
            },
            'branches' => function ($query) {
                $query->withTrashed();
            }
        ])->get();
        return view('itd-leader.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branches::where('status', 1)->get();
        return view('itd-leader.positions.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Positions::create($data);
        return redirect()->route('itd-leader.positions.index')->with('success', 'Məlumatlar əlavə edildi');
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
        $position = Positions::findOrFail($id);
        $branches = Branches::where('status', 1)->get();
        return view('itd-leader.positions.edit', compact('position', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $position = Positions::findOrFail($id);
        $position->update($data);

        return redirect()->route('itd-leader.positions.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Positions::findOrFail($id);
        $position->delete();
        return redirect()->route('itd-leader.itd-leader.positions.index')->with('success', 'Məlumatlar silindi');
    }

    public function get_positions_by_branch(Request $request)
    {
        $positions = DB::table('positions')
            ->select('positions.*', DB::raw('(SELECT COUNT(*) FROM users WHERE users.positions_id = positions.id) as users_count'))
            ->where('status', 1)
            ->where('branches_id', $request->branch_id)
            ->whereRaw('(SELECT COUNT(*) FROM users WHERE users.positions_id = positions.id) < count')
            ->get();

        return $positions;
    }

    public function get_positions_by_management_board(Request $request)
    {
        $positions = Positions::doesntHave('users')->where('status', 1)->where('branches_id', NULL)->where('departments_id', NULL)->get();
        return $positions;
    }

    public function get_positions_by_null_department(Request $request)
    {
        $positions = Positions::doesntHave('users')->where('status', 1)->where('departments_id', $request->department_id)->where('branches_id', NULL)->get();
        return $positions;
    }
}
