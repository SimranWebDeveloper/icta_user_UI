<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\Vendors;
use Illuminate\Http\Request;

class ACCVendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendors::all();
        return view('accountant.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accountant.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Vendors::create($data);
        return redirect()->route('accountant.vendors.index')->with('success', 'Məlumatlar əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendor = Vendors::with('invoices.products')->find($id);
        return view('accountant.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendors::findOrFail($id);
        return view('accountant.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $vendors = Vendors::findOrFail($id);
        $vendors->update($data);

        return redirect()->route('accountant.vendors.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendors = Vendors::findOrFail($id);
        $vendors->delete();
        return redirect()->route('accountant.accountant.vendors.index')->with('success', 'Məlumatlar silindi');
    }
}
