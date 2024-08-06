<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralSettings extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'general_settings';
    protected $fillable = [
        'welcome_message',
        'repair_mode',
        'repair_mode_message',
        'weekly_report_module',
        'weekly_report_module_users',
        'ticket_module',
        'assets_requests',
        'delivery_act_generation',
        'delivery_act_content',
        'delivery_to_another_employee_act_generation',
        'delivery_to_another_employee_act_content',
        'notification_module',
        'notification_content',
        'hr_blog_module',
    ];
}
