<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Departments;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branches::with([
            'departments' => function ($query) {
                $query->withTrashed();
            }
        ])->get();
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::where('status', 1)->get();
        return view('admin.branches.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Branches::create($data);
        return redirect()->route('admin.branches.index')->with('success', 'Məlumatlar əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branches::with('users', 'positions')->find($id);
        return view('admin.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Departments::where('status', 1)->get();
        $branch = Branches::findOrFail($id);
        return view('admin.branches.edit', compact('branch', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $branches = Branches::findOrFail($id);
        $branches->update($data);

        return redirect()->route('admin.branches.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branches::find($id);
        $branch->delete();
        return response()->json([
            'message' => 'Məlumatlar müvəffəqiyyətlə silindi',
            'route' => route('admin.branches.index')
        ]);
    }

    public function get_branches_by_department(Request $request)
    {
        $branches = Branches::where('status', 1)->where('departments_id', $request->department_id)->get();
        return $branches;
    }



}
