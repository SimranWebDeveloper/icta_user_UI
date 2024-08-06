<?php

namespace App\Http\Controllers\Warehouseman;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Invoices;
use App\Models\Stocks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WHMProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('stocks as s')
            ->leftJoin('products as p', 's.product_unical_code', '=', 'p.unical_code')
            ->leftJoin('categories as c', 'p.categories_id', '=', 'c.id')
            ->leftJoin('invoices as inv', 'p.invoices_id', '=', 'inv.id')
            ->leftJoin('hand_registers as hr', 'p.hand_registers_id', '=', 'hr.id')
            ->leftJoin('vendors as v', function ($join) {
                $join->on('inv.vendors_id', '=', 'v.id')
                    ->orOn('hr.vendors_id', '=', 'v.id');
            })
            ->select('p.product_name', 'p.size', 'p.material_type', 'p.status','p.activity_status' ,'inv.e_invoice_number', 'inv.e_invoice_serial_number', 'inv.e_invoice_date' ,'hr.register_number', 'c.name as category_name', 's.*', 'v.name as vendor_name')
            ->groupBy('ims.s.deleted_at','p.product_name', 'p.material_type', 'p.size', 'p.status','p.activity_status' ,'inv.e_invoice_number', 'inv.e_invoice_date','inv.e_invoice_serial_number', 'hr.register_number' , 'category_name', 's.id', 's.warehouses_id', 's.product_unical_code', 's.purchase_count', 's.stock_count', 's.created_at', 's.updated_at', 'v.name')
            ->get();
        
        return view('warehouseman.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Products::create($data);
        return redirect()->route('warehouseman.products.index')->with('success', 'Məlumatlar əlavə edildi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    public function details(Request $request)
    {
        $products = Products::where('unical_code', $request->productCode)->get();
        $users = User::where('type', 'employee')->get();
        return view('warehouseman.warehouses.products.details', compact('products', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::findOrFail($id);
        $categories = Categories::all();
        return view('warehouseman.products.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {    
        $product = Products::findOrFail($id);

        $oldPrice=$product->price;

        $product->update([
            'categories_id' => $request->category_id,
            'material_type' => $request->material_type,
            'avr_code' => $request->avr_code,
            'serial_number' => $request->serial_number,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'inventory_cost' => $request->inventory_cost,
            'size' => $request->size,
            'activity_status' => $request->activity_status,
            'status' => $request->status,
        ]);
        
        if($request->price !== $oldPrice)
        {
            $products = Products::where('invoices_id', $product->invoices_id)->get();
            

            $totalAmount = $products->sum('price');
            $invoice = Invoices::findOrFail($product->invoices_id);

            $invoice->update(['total_amount' => $totalAmount]);
            $invoice->update(['edv_total_amount' => $totalAmount *1.18]);
        }

        return redirect()->route('warehouseman.invoices.show',$product->invoices_id)->with('success', 'Məlumatlar dəyişdirildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $invoice_id = $product->invoices_id;

        $product->delete();

        $products = Products::where('invoices_id', $invoice_id)->get();
        $totalAmount = $products->sum('price');

        $invoice = Invoices::findOrFail($invoice_id);

        $invoice->update([
            'total_amount' => $totalAmount,
            'edv_total_amount' => $totalAmount * 1.18
        ]);

        return response()->json([
            'message' => 'Məlumatlar silindi',
            'route' => route('warehouseman.invoices.show', $invoice_id)
        ]);
    }


}
