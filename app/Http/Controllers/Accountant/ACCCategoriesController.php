<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class ACCCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('accountant.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::where('status', 1)->get();
        return view('accountant.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['parent_id'] = $data['parent_id'] === "NULL" ? NULL : $data['parent_id'];
        Categories::create($data);
        return redirect()->route('accountant.categories.index')->with('success', 'Məlumatlar əlavə edildi');
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
        $category = Categories::findOrFail($id);
        $categories = Categories::where('status', 1)->get();
        return view('accountant.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $data['parent_id'] = $data['parent_id'] === "NULL" ? NULL : $data['parent_id'];
        $categories = Categories::findOrFail($id);
        $categories->update($data);

        return redirect()->route('accountant.categories.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect()->route('accountant.categories.index')->with('success', 'Məlumatlar silindi');
    }
}
