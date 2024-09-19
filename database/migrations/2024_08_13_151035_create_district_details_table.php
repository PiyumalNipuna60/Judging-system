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
        Schema::create('district_details', function (Blueprint $table) {
            $table->increments('district_detail_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('teacher_id');
            $table->timestamps();
            $table->foreign('district_id')->references('district_id')->on('districts')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_details');
    }
};
