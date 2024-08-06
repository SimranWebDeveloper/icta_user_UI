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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('operator_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('helpdesk_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('appointments_id')->constrained('appointments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ticket_reasons_id')->constrained('ticket_reasons')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ticket_number')->unique();
            $table->integer('status')->default(0);
            $table->integer('ticket_status')->default(0);
            $table->integer('rate')->default(5);
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
