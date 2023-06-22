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
        Schema::create('manage_exams', function (Blueprint $table) {
            $table->id();
            $table->string('departmentName');
            $table->string('subjectName');
            $table->string('chapterName');
            $table->string('questionCat');
            $table->string('question_type');
            $table->string('set');
            $table->string('isStartExam');
            $table->string('isEndExam')->nullable();
            $table->string('username');
            $table->string('totalQuestion')->nullable();
            $table->string('wrongAnswer')->nullable();
            $table->string('correctAnswer')->nullable();
            $table->string('untouch')->nullable();
            $table->string('yourAnswers')->nullable();
            $table->string('affordMsg')->nullable();
            $table->string('status')->default(1);
            $table->string('isclickedSeeResult')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_exams');
    }
};
