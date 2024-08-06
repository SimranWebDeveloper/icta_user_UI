<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('welcome_message')->nullable();
            $table->integer('repair_mode')->default(0);
            $table->string('repair_mode_message')->nullable();
            $table->integer('weekly_report_module')->default(0);
            $table->jsonb('weekly_report_module_users')->nullable();
            $table->jsonb('weekly_report_receivers')->nullable();
            $table->integer('ticket_module')->default(0);
            $table->integer('assets_requests')->default(0);
            $table->integer('delivery_act_generation')->default(0);
            $table->text('delivery_act_content')->nullable();
            $table->integer('delivery_to_another_employee_act_generation')->default(0);
            $table->text('delivery_to_another_employee_act_content')->nullable();
            $table->integer('notification_module')->default(0);
            $table->text('notification_content')->nullable();
            $table->integer('hr_blog_module')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
