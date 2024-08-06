<?php

namespace App\Http\Controllers\Warehouseman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetsRequests;
use App\Models\AssetsRequestsDetails;

class WHMAssetsController extends Controller
{
    public function index() {
        $assets= AssetsRequests::with('user')->get();

        return view('warehouseman.assets-requests.index', compact('assets'));
    }

    public function submit(Request $request) {
        $detail = AssetsRequestsDetails::findOrFail($request->detailId);

        if (isset($request->reason)){
            $detail->reject_reason = $request->reason;
            $detail->status = 0;
            $detail->save();
            return response()->json([
                'message' => 'Mal-material sorğusu geri çevrildi.'
            ]);
        }
        else{
            $detail->status = 2;
            $detail->save();
            return response()->json([
                'message' => 'Mal-material sorğusu təsdiq edildi.'
            ]);
        }
    }
}
