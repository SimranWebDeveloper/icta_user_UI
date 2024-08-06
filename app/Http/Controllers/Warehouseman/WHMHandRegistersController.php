<?php

namespace App\Http\Controllers\Warehouseman;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\HandRegisters;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\Vendors;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WHMHandRegistersController extends Controller
{
    public function index()
    {
        $registers = HandRegisters::all();
        return view('warehouseman.hand-registers.index', compact('registers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $whs = Warehouses::where('status', 1)->get();
        $categories = Categories::whereNull('parent_id')->where('status', 1)->get();
        $vendors = Vendors::where('status', 1)->get();
        return view('warehouseman.hand-registers.create', compact('categories', 'vendors', 'whs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $total_product_price = 0;
        $products = [];
        foreach ($request->product_name as $product_key => $item) {
            $unical_code = Str::random(10);
            if ($request->material_type[$product_key] != 'Mal-material') {
                for ($i = 0; $i < $request->purchase_count[$product_key]; $i++) {
                    $rowName = $request->unique_row_name[$product_key];
                    $clean_code = $request->$rowName;
                    $products[] = [
                        'warehouses_id' => $request->warehouses_id,
                        'invoices_id' => NULL,
                        'hand_registers_id' => NULL,
                        'categories_id' => $request->subcategories_id[$product_key],
                        'unical_code' => $unical_code,
                        'material_type' => $request->material_type[$product_key],
                        'avr_code' => $request->material_type[$product_key] == 'Əsas inventar' ? NULL : $clean_code[$i],
                        'serial_number' => $request->material_type[$product_key] != 'Əsas inventar' ? NULL : $clean_code[$i],
                        'product_name' => $item,
                        'price' => $request->price[$product_key],
                        'size' => $request->size[$product_key],
                        'inventory_cost' => $request->inventory_cost[$product_key],
                        'activity_status' => $request->activity_status[$product_key],
                        'status' => $request->status[$product_key]
                    ];
                    $total_product_price += $request->price[$product_key];
                }
            } else {
                for ($i = 0; $i < $request->purchase_count[$product_key]; $i++) {
                    $products[] = [
                        'warehouses_id' => $request->warehouses_id,
                        'invoices_id' => NULL,
                        'hand_registers_id' => NULL,
                        'categories_id' => $request->subcategories_id[$product_key],
                        'unical_code' => $unical_code,
                        'material_type' => $request->material_type[$product_key],
                        'avr_code' => NULL,
                        'serial_number' => NULL,
                        'product_name' => $item,
                        'price' => $request->price[$product_key],
                        'size' => $request->size[$product_key],
                        'inventory_cost' => $request->inventory_cost[$product_key],
                        'activity_status' => $request->activity_status[$product_key],
                        'status' => $request->status[$product_key]
                    ];
                }
                $total_product_price += $request->price[$product_key] * $request->purchase_count[$product_key];
            }


            $stock_data = [
                'warehouses_id' => $request->warehouses_id,
                'product_unical_code' => $unical_code,
                'purchase_count' => $request->purchase_count[$product_key],
                'stock_count' => $request->purchase_count[$product_key],
            ];

            Stocks::create($stock_data);

        }

        $register = HandRegisters::create([
            'invoices_id' => NULL,
            'vendors_id' => $request->vendors_id,
            'categories_id' => $request->main_categories_id,
            'register_number' => $request->register_number,
            'register_date' => $request->register_date,
            'total_amount' => $total_product_price,
            'edv_total_amount' => $total_product_price + $total_product_price * 0.18,
            'note' => $request->note,
            'e_invoice_date' => $request->e_invoice_date
        ]);

        Products::insert(array_map(function ($data) use ($register) {
            $data['hand_registers_id'] = $register->id;
            return $data;
        }, $products));

        return redirect()->route('warehouseman.hand-registers.index')->with('success', 'Məlumatlar daxil edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $register = HandRegisters::with('products')->find($id);
        return view('warehouseman.hand-registers.show', compact('register'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
