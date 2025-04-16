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
        Schema::create('service_operationals', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('check');
            $table->string('vehicle_type');
            $table->string('plate_number');
            $table->boolean('stnk')->default(false)->nullable();
            $table->boolean('kunci')->default(false)->nullable();
            $table->integer('payment_method')->nullable();
            $table->boolean('status')->default(false);
           $table->timestampsTz(0, 'Asia/Jakarta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_operationals');
    }
};
