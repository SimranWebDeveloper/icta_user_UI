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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendors_id')->constrained('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('categories_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('e_invoice_number', 50)->nullable();
            $table->string('e_invoice_serial_number', 50)->nullable();
            $table->float('total_amount');
            $table->float('edv_total_amount');
            $table->text('note')->nullable();
            $table->date('e_invoice_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
