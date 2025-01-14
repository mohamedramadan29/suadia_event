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
        Schema::create('invoice_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->cascadeOnDelete();
            $table->string('image');
            $table->foreignId('user_upload')->nullable()->references('id')->on('admins')->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_images');
    }
};
