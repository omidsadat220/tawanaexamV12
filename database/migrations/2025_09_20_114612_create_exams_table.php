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
        Schema::create('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('class_subject_id')->nullable();
            $table->string('subject_name');
            $table->string('exam_name');
            $table->integer('time');
            $table->timestamps();

             $table->foreign('class_subject_id')->references('id')->on('class_subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
