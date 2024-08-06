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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departments_id')->nullable()->constrained('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('branches_id')->nullable()->constrained('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('positions_id')->nullable()->constrained('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kpi_positions_id')->nullable()->constrained('kpi_positions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rooms_id')->constrained('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('b_day');
            $table->foreignId('report_receiver_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('assets_requests_id')->nullable();
            $table->string('type')->default('employee');
            $table->string('role')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->integer('read_notf')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
