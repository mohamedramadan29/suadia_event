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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collage_id')->references('id')->on('collages')->cascadeOnDelete();
            $table->string('event_name');
            $table->string('event_location');
            $table->string('event_start_month');
            $table->string('event_start_day')->nullable();
            $table->string('event_start_time')->nullable();
            $table->string('event_end_month')->nullable();
            $table->string('event_end_day')->nullable();
            $table->string('event_end_time')->nullable();
            $table->foreignId('event_type_id')->references('id')->on('eventtypes')->cascadeOnDelete();
            $table->string('event_status')->default('1');
            $table->string('event_image')->nullable();
            $table->string('event_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
