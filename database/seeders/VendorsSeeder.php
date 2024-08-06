<?php

namespace Database\Seeders;

use App\Models\Vendors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'INFINITECH MMC',
            'Baktelekom',
            'Nazirlik'
        ];

        foreach ($array as $item)
        {
            Vendors::create([
                'name'=>$item,
                'status'=>1
            ]);
        }
    }
}
