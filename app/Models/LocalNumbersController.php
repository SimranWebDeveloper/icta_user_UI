<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Departments;
use App\Models\LocalNumbers;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;

class LocalNumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numbers = LocalNumbers::all();
        return view('admin.local-numbers.index', compact('numbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::where('status', 1)->get();
        $branches = Branches::where('status', 1)->get();
        $rooms = Rooms::where('status', 1)->get();
        $users = User::where('type', 'employee')->get();
        return view('admin.local-numbers.create', compact('users', 'departments', 'branches', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($data['for_who'] == 'departments')
        {
            $data['branches_id'] = NULL;
            $data['rooms_id'] = NULL;
            $data['users_id'] = NULL;
        }
        elseif ($data['for_who'] == 'branches')
        {
            $branch = Branches::find($data['branches_id']);
            $data['departments_id'] = isset($branch->departments) ? $branch->departments->id : NULL;
            $data['rooms_id'] = NULL;
            $data['users_id'] = NULL;
        }
        elseif($data['for_who'] == 'rooms')
        {
            $data['departments_id'] = NULL;
            $data['branches_id'] = NULL;
            $data['users_id'] = NULL;
        } elseif ($data['for_who'] == 'users')
        {
            $user = User::find($data['users_id']);
            $data['departments_id'] = $user->departments_id ?? NULL;
            $data['branches_id'] = $user->branches_id ?? NULL;
            $data['rooms_id'] = $user->rooms_id ?? NULL;
        }
        LocalNumbers::create($data);
        return redirect()->route('admin.local-numbers.index')->with('success', 'Məlumatlar əlavə edildi');
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
        $departments = Departments::where('status', 1)->get();
        $branches = Branches::where('status', 1)->get();
        $rooms = Rooms::where('status', 1)->get();
        $users = User::where('type', 'employee')->get();
        $number = LocalNumbers::findOrFail($id);
        return view('admin.local-numbers.edit', compact('number', 'users', 'departments', 'branches', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        if($data['for_who'] == 'departments')
        {
            $data['branches_id'] = NULL;
            $data['rooms_id'] = NULL;
            $data['users_id'] = NULL;
        }
        elseif ($data['for_who'] == 'branches')
        {
            $branch = Branches::find($data['branches_id']);
            $data['departments_id'] = isset($branch->departments) ? $branch->departments->id : NULL;
            $data['rooms_id'] = NULL;
            $data['users_id'] = NULL;
        }
        elseif($data['for_who'] == 'rooms')
        {
            $data['departments_id'] = NULL;
            $data['branches_id'] = NULL;
            $data['users_id'] = NULL;
        } elseif ($data['for_who'] == 'users')
        {
            $user = User::find($data['users_id']);
            $data['departments_id'] = $user->departments_id ?? NULL;
            $data['branches_id'] = $user->branches_id ?? NULL;
            $data['rooms_id'] = $user->rooms_id ?? NULL;
        }
        $number = LocalNumbers::findOrFail($id);
        $number->update($data);

        return redirect()->route('admin.local-numbers.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = LocalNumbers::findOrFail($id);
        $department->delete();
        return redirect()->route('admin.admin.local-numbers.index')->with('success', 'Məlumatlar silindi');
    }
}
