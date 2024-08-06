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
        $numbers = LocalNumbers::with('departments')->get();
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
            $data['branch_id'] = NULL;
            $data['room_id'] = NULL;
            $data['user_id'] = NULL;
        }
        elseif ($data['for_who'] == 'branches')
        {
            $branch = Branches::find($data['branch_id']);
            $data['department_id'] = isset($branch->departments) ? $branch->departments->id : NULL;
            $data['room_id'] = NULL;
            $data['user_id'] = NULL;
        }
        elseif($data['for_who'] == 'rooms')
        {
            $data['department_id'] = NULL;
            $data['branch_id'] = NULL;
            $data['user_id'] = NULL;
        } elseif ($data['for_who'] == 'users')
        {
            $user = User::find($data['user_id']);
            $data['department_id'] = $user->departments_id ?? NULL;
            $data['branch_id'] = $user->branches_id ?? NULL;
            $data['room_id'] = $user->rooms_id ?? NULL;
        }
        LocalNumbers::create([
            'departments_id' => $data['department_id'],
            'branches_id' => $data['branch_id'],
            'rooms_id' => $data['room_id'],
            'users_id' => $data['user_id'],
            'departments_id' => $data['department_id'],
            'number' => $data['number'],
            'status' => $data['status'],
        ]);
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
            $data['branch_id'] = NULL;
            $data['room_id'] = NULL;
            $data['user_id'] = NULL;
        }
        elseif ($data['for_who'] == 'branches')
        {
            $branch = Branches::find($data['branch_id']);
            $data['department_id'] = isset($branch->departments) ? $branch->departments->id : NULL;
            $data['room_id'] = NULL;
            $data['user_id'] = NULL;
        }
        elseif($data['for_who'] == 'rooms')
        {
            $data['department_id'] = NULL;
            $data['branch_id'] = NULL;
            $data['user_id'] = NULL;
        } elseif ($data['for_who'] == 'users')
        {
            $user = User::find($data['user_id']);
            $data['department_id'] = $user->departments_id ?? NULL;
            $data['branch_id'] = $user->branches_id ?? NULL;
            $data['room_id'] = $user->rooms_id ?? NULL;
        }
        $number = LocalNumbers::findOrFail($id);
        $number->departments_id = $data['department_id'];
        $number->branches_id = $data['branch_id'];
        $number->rooms_id = $data['room_id'];
        $number->users_id = $data['user_id'];
        $number->number = $data['number'];
        $number->status = $data['status'];
        $number->save();

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
