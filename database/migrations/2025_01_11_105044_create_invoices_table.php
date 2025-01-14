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
            $table->integer('invoice_number');
            $table->string('name');
            $table->string('phone');
            $table->json('problems');
            $table->string('title')->comment('problem');
            $table->text('description');
            $table->double('price');
            $table->string('date_delivery')->nullable();
            $table->string('time_delivery')->nullable();
            $table->string('status');
            $table->string('status_notes')->nullable();
            $table->foreignId('admin_recieved_id')->nullable()->references('id')->on('admins')->nullOnDelete();
            $table->foreignId('admin_repair_id')->nullable()->references('id')->on('admins')->nullOnDelete();
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
