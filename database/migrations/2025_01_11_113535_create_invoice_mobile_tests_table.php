<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_mobile_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->cascadeOnDelete();
            $table->string('device_name');
            $table->string('device_model');
            $table->string('buttons');
            $table->text('buttons_notes')->nullable();
            $table->string('screen');
            $table->text('screen_notes')->nullable();
            $table->string('camera');
            $table->text('camera_notes')->nullable();
            $table->text('other_problems')->nullable();
            $table->date('repair_tiem');
            $table->double('repair_price');
            $table->text('technical_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_mobile_tests');
    }
};
