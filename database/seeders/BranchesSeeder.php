<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $branches_array = [
            [
                'departments_id' => 1,
                'name' => 'Elektron kommunikasiya şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'name' => 'Texniki tənzimləmə şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'name' => 'Poçt rabitəsi şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 1,
                'name' => 'Radiospektr idarəçiliyi şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'name' => 'Xidmət bazarına nəzarət şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 2,
                'name' => 'İstehlakçı hüquqları şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'name' => 'Rəqəmsal təminat və inkişaf şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 3,
                'name' => 'Şəbəkə inzibatçılığı və texniki dəstək şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'name' => 'Hüquq şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 4,
                'name' => 'Sənədlərlə iş şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'name' => 'Maliyyə şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'name' => 'İnsan resursları şöbəsi',
                'status' => 1
            ],
            [
                'departments_id' => 5,
                'name' => 'Satınalma və təsərrüfat şöbəsi',
                'status' => 1
            ],
        ];

        foreach ($branches_array as $item) {
            Branches::create($item);
        }
    }
}
