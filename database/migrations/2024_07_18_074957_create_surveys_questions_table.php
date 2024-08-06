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
        Schema::create('surveys_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surveys_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('question');
            $table->string('input_type');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys_questions');
    }
};
