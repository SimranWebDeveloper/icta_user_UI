<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;

class ITDRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::all();
        return view('itd-leader.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('itd-leader.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Rooms::create($data);
        return redirect()->route('itd-leader.rooms.index')->with('success', 'Məlumatlar əlavə edildi');
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
        $room = Rooms::findOrFail($id);
        return view('itd-leader.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $rooms = Rooms::findOrFail($id);
        $rooms->update($data);

        return redirect()->route('itd-leader.rooms.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rooms = Rooms::findOrFail($id);
        $rooms->delete();
        return redirect()->route('itd-leader.itd-leader.rooms.index')->with('success', 'Məlumatlar silindi');
    }
}
