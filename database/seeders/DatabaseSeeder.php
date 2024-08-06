<?php

namespace Database\Seeders;

use App\Models\Branches;
use App\Models\Categories;
use App\Models\Departments;
use App\Models\GeneralSettings;
use App\Models\Positions;
use App\Models\Rooms;
use App\Models\TicketReasons;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vendors;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentsSeeder::class);
        $this->call(BranchesSeeder::class);
        $this->call(PositionsSeeder::class);
        $this->call(RoomsSeeder::class);
        $this->call(CategoriesSeeder::class);
//         $this->call(EmployeesSeeder::class);
        $this->call(VendorsSeeder::class);
        $this->call(GeneralSettingsSeeder::class);

        User::create([
            'departments_id' => NULL,
            'branches_id' => NULL,
            'positions_id' => NULL,
            'rooms_id' => 1,
            'name' => 'Röya Quliyeva',
            'email' => 'admin@icta.az',
            'password' => bcrypt('salamadmin'),
            'type' => 'administrator,employee,warehouseman,hr,finance,support',
            'b_day' => Carbon::now()->format('Y-m-d')
        ]);
//
//        User::create([
//            'departments_id' => NULL,
//            'branches_id' => NULL,
//            'positions_id' => NULL,
//            'rooms_id' => 1,
//            'name' => 'Elman Ənvərli',
//            'email' => 'whm@icta.az',
//            'password' => bcrypt('icta123'),
//            'type' => 'warehouseman',
//            'b_day' => Carbon::now()->format('Y-m-d')
//        ]);
//
//        User::create([
//            'departments_id' => NULL,
//            'branches_id' => NULL,
//            'positions_id' => NULL,
//            'rooms_id' => 1,
//            'name' => 'Cavid Həsənli',
//            'email' => 'support@icta.az',
//            'password' => bcrypt('icta123'),
//            'type' => 'support',
//            'b_day' => Carbon::now()->format('Y-m-d')
//        ]);

        TicketReasons::create([
            'reason' => 'Səbəb 1',
            'status' => 1
        ]);
        TicketReasons::create([
            'reason' => 'Səbəb 2',
            'status' => 1
        ]);
        TicketReasons::create([
            'reason' => 'Səbəb 3',
            'status' => 1
        ]);
    }
}
