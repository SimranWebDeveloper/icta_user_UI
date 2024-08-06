<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Models\GeneralSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSettings::create([
            'welcome_message' => 'Hörmətli' . 'istifadəçi, sistemin təhlükəsizliyi üçün şifrənizi gizli saxlamaşınız xahil olunur. Diqqətiniz üçün təşəkkür edirik.',
            'repair_mode' => 0,
            'repair_mode_message' => 'Sistem müvafiq yenilənmələr üçün təmirə bağlanıb',
            'weekly_report_module' => 0,
            'weekly_report_module_users' => NULL,
            'ticket_module' => 0,
            'assets_requests' => 0,
            'delivery_act_generation' => 0,
            'delivery_act_content' => NULL,
            'delivery_to_another_employee_act_generation' => 0,
            'delivery_to_another_employee_act_content' => NULL,
            'notification_module' => 0,
            'notification_content' => NULL,
            'hr_blog_module' => 0,
        ]);

    }
}
