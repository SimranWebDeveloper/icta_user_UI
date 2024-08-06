<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ITDDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::all();
        return view('itd-leader.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('itd-leader.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Departments::create($data);
        return redirect()->route('itd-leader.departments.index')->with('success', 'Məlumatlar əlavə edildi');
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
        $department = Departments::findOrFail($id);
        return view('itd-leader.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $department = Departments::findOrFail($id);
        $department->update($data);

        return redirect()->route('itd-leader.departments.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Departments::find($id);
        $department->delete();
        return response()->json([
            'message' => 'Məlumatlar müvəffəqiyyətlə silind',
            'route' => route('itd-leader.departments.index')
        ]);
    }

}
