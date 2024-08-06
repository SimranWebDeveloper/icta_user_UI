<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_user(Request $request)
    {
        $users = User::query()
            ->when($request->filled('data'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->data . '%');
            })
            ->get();
        return response()->json([
            'status' => 200,
            'result' => $users
        ]);
    }
}
