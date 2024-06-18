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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->string('short_description', 255);
            $table->text('long_description');
            $table->string('info1', 255);
            $table->string('info2', 255);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('registration_deadline');
            $table->string('contact_email',45);
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('address_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
