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
        Schema::create('assets_requests_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assets_requests_id')->constrained('assets_requests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->string('reject_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_requests_details');
    }
};
