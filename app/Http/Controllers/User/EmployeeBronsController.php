<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeBronsController extends Controller
{
    public function index()
    {
        return view('employee.brons.index');

    }

    
    public function create()
    {
        return view('employee.brons.create');

    }

   
    public function store(Request $request)
    {
        return view('employee.brons.index');

    }

   
    public function show(string $id) 
    {
        return view('employee.brons.show');

    }
    
    public function edit(string $id) 
    {
        return view('employee.brons.edit');

    }

    
    public function update(Request $request, string $id) 
    {
        return view('employee.brons.index');

    }

    
    public function destroy(string $id) 
    {
        return view('employee.brons.index');

    }
}
