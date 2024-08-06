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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rooms_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('subject', 255);
            $table->text('content');
            $table->integer('status');
            $table->dateTime('start_date_time');
            $table->integer('duration');
            // default 0 = iclas;
            $table->boolean('type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
