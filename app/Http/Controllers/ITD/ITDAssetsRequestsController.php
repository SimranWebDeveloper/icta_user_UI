<?php

namespace App\Http\Controllers\ITD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetsRequests;
use App\Models\AssetsRequestsDetails;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ITDAssetsRequestsController extends Controller
{
    public function index() {

        $assets= AssetsRequests::with('user', 'assets_requests_details')->get();

        $kUserIds = User::whereNotNull('assets_requests_id')
            ->where('assets_requests_id', '<', Auth::user()->assets_requests_id)
            ->pluck('id')->toArray();


        foreach ($assets as $res_key => $assets_requests) {
            $check_available[$res_key] = false;
            foreach ($assets_requests->assets_requests_details->whereIn('users_id', $kUserIds) as $assets_requests_details) {
                $check_available[$res_key] = $assets_requests_details->status == 2 ? true : false;
            }
        }

        return view('itd-leader.assets-requests.index', compact('assets' , 'kUserIds', 'check_available'));
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
