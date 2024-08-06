<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ACCWarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whs = Warehouses::select('warehouses.*', DB::raw('SUM(stocks.purchase_count) as total_purchase_count'))
            ->leftJoin('stocks', 'warehouses.id', '=', 'stocks.warehouses_id')
            ->groupBy('warehouses.id', 'warehouses.name', 'warehouses.address', 'warehouses.status', 'warehouses.created_at', 'warehouses.updated_at' , 'ims.warehouses.deleted_at')
            ->get();
        return view('accountant.warehouses.index', compact('whs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accountant.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Warehouses::create($data);
        return redirect()->route('accountant.warehouses.index')->with('success', 'Məlumatlar əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $whs = Warehouses::find($id);
        return view('accountant.warehouses.products.index', compact('whs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $whs = Warehouses::findOrFail($id);
        return view('accountant.warehouses.edit', compact('whs'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $whs = Warehouses::findOrFail($id);
        $whs->update($data);

        return redirect()->route('accountant.warehouses.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $whs = Warehouses::findOrFail($id);
        $whs->delete();
        return redirect()->route('accountant.warehouses.index')->with('success', 'Məlumatlar silindi');
    }
}
