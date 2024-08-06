<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Inventories;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventories::with('products', 'user')->get();
        return view('admin.inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_products = Products::all();
        $products = [];
        foreach ($all_products as $product) {
            $stock = $product->stock;
            $inventoryCount = $product->inventories_count;
            if ($stock > $inventoryCount) {
                $products[] = $product;
            }
        }

        $users = User::where('type', 'employee')->get();
        return view('admin.inventories.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->users_id as $user_key => $user) {
            Inventories::create([
                'user_id' => $user,
                'products_id' => $request->products_id[$user_key],
                'inventory_number' => $request->inventory_number[$user_key]
            ]);

            $product = Products::find($request->products_id[$user_key]);
            $product->stock = $product->stock - 1;
            $product->save();
        }

        return redirect()->route('admin.inventories.index')->with('success', 'Məlumatlar daxil edildi');
    }

    public function refund(Request $request)
    {
        $transaction = Inventories::find($request->id);
        $transaction->user_id = NULL;
        $transaction->save();

        $product = Products::find($transaction->products_id);
        $product->stock += 1;
        $product->save();

        return redirect()->back()->with('success', 'İnventar anbara qaytarıldı');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventories $inventories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventories $inventory)
    {
        $products = Products::all();
        $users = User::where('type', 'employee')->get();
        return view('admin.inventories.edit', compact('products', 'users', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventories $inventory)
    {
        $inventory->update([
            'products_id' => $request->products_id,
            'inventory_number' => $request->inventory_number,
            'users_id' => $request->users_id_new
        ]);

        return redirect()->route('admin.inventories.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventories $inventories)
    {
        //
    }
}
