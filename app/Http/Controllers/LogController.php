<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function create_logs($content, $type)
    {
        Logs::create([
            'type' => $type,
            'content' => $content
        ]);
    }

    public function logs()
    {
        $logs = Logs::all();
        return view('admin.logs', compact('logs'));
    }
}
