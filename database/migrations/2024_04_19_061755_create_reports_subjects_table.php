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
        Schema::create('reports_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reports_id')->nullable()->constrained('reports')->onUpdate('cascade')->onDelete('cascade');
            $table->string('project_name');
            $table->string('subject');
            $table->integer('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports_subjects');
    }
};
