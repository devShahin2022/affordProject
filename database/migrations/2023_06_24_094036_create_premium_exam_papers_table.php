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
        Schema::create('premium_exam_papers', function (Blueprint $table) {
            $table->id();
            $table->string("ExamTitle");
            $table->string("departmentName");
            $table->string("subjectName");
            $table->string("chapterName");
            $table->string("question_set");
            $table->string("isCurrent")->default(1);
            $table->string("startDate");
            $table->string("endingDate");
            $table->string("targetClass");
            $table->string("whichSection");
            $table->string("deadLine");
            $table->string("isAlreadyPublished")->default(1);
            $table->string("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premium_exam_papers');
    }
};
