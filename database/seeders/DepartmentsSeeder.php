<?php

namespace Database\Seeders;

use App\Models\Departments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments_array = [
            [
                'name' => 'Tənzimləmə departamenti',
                'status' => 1
            ],
            [
                'name' => 'Xidmət bazarlarına nəzarət və istehlakçı hüquqları departamenti',
                'status' => 1
            ],
            [
                'name' => 'İnformasiya texnologiyaları departamenti',
                'status' => 1
            ],
            [
                'name' => 'Hüquq və sənədlərlə iş departamenti',
                'status' => 1
            ],
            [
                'name' => 'Müstəqil',
                'status' => 1
            ]
        ];

        foreach ($departments_array as $item) {
            Departments::create($item);
        }

    }
}
