<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointments::with('products', 'user')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $products = Products::doesntHave('appointments')->get();
        $users = User::where('type', 'employee')->get();
        return view('admin.appointments.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->users_id as $user_key => $user) {
            Appointments::create([
                'user_id' => $user,
                'products_id' => $request->products_id[$user_key],
                'inventory_number' => $request->inventory_number[$user_key]
            ]);

            $product = Products::find($request->products_id[$user_key]);
            $stock = Stocks::where('product_unical_code', $product->unical_code)->first();
            if ($stock) {
                $newStockCount = $stock->stock_count - 1;
                $stock->update([
                    'stock_count' => $newStockCount
                ]);
            }
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Məlumatlar daxil edildi');
    }

    public function refund(Request $request)
    {
        $transaction = Appointments::find($request->id);
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
    public function show(Appointments $inventories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointment)
    {
        $users = User::where('type', 'employee')->get();
        return view('admin.appointments.edit', compact( 'users', 'appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointment)
    {
        $appointment->update([
            'products_id' => $request->products_id,
            'inventory_number' => $request->inventory_number,
            'user_id' => $request->users_id_new
        ]);
        $appointment->save();

        return redirect()->route('admin.appointments.index')->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $inventories)
    {
        //
    }
}
