<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AssetsRequests;
use App\Models\AssetsRequestsDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAssetsRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_assets_requests = Auth::user()->assets_requests()->with('assets_requests_details')->get();
        $users = User::whereNotNull('assets_requests_id')->orderBy('assets_requests_id', 'ASC')->get();
        return view('employee.assets-requests.index', compact('users', 'user_assets_requests'));
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
        $first_request = AssetsRequests::create([
            'user_id' => Auth::user()->id,
            'content' => $request->assets_content
        ]);

        $user_selected = User::whereNotNull('assets_requests_id')->orderBy('assets_requests_id', 'ASC')->get();
        foreach($user_selected as $user){
            AssetsRequestsDetails::create([
                'assets_requests_id' => $first_request->id,
                'users_id' => $user->id,
                'status' => 1
            ]);
        }
        return response()->json([
            'route' => route('employee.assets-requests.index'),
            'message' => 'Mal-material sorğusu müvəffəqiyyətlə yaradıldı',
            'status' => 200
        ]);
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
    public function destroy($id)
    {
        try {
            $assetRequest = AssetsRequests::findOrFail($id);

            $assetRequest->assets_requests_details()->delete();

            $assetRequest->delete();

            return response()->json([
                'message' => 'Sorğu müvəffəqiyyətlə silindi',
                'status' => 200
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Sorğunu silmək mümkün olmadı. Xəta: ' . $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
