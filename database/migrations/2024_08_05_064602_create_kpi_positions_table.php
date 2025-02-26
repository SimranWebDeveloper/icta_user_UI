<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kpi_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departments_id')->nullable()->constrained('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('branches_id')->nullable()->constrained('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_positions');
    }
};
