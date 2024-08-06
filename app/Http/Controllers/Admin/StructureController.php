<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;

class StructureController extends Controller
{
    public function index()
    {
        $departments = Departments::with('branches.positions')->get();
        $cleanedDepartmentsArray[] = [
            "id" => 0,
            "name" => "İnformasiya Kommunikasiya Texnologiyaları Agentliyi",
            "institution_id" => null,
            "parentId" => null
        ];
        foreach ($departments as $department) {
            $cleanedDepartmentsArray[] = [
                "id" => $department->id,
                "name" => $department->name,
                "institution_id" => "İnformasiya Kommunikasiya Texnologiyaları Agentliyi",
                "parentId" => 0
            ];
            foreach ($department->branches as $branch) {
                $cleanedDepartmentsArray[] = [
                    "id" => $branch->id,
                    "name" => $branch->name,
                    "institution_id" => $department->name,
                    "parentId" => 0
                ];
            }

        }

        return view('admin.structures.index', compact('cleanedDepartmentsArray'));
    }
}
