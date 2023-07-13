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
        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string("departmentName");
            $table->string("subjectName");
            $table->string("chapterName");
            $table->string("cat_no");
            $table->string("quesTypeTitle");
            $table->string("questionImg")->nullable();
            $table->string("question");
            $table->string("answerImg")->nullable();
            $table->string("answer")->nullable();
            $table->string("justAnswer")->nullable();
            $table->string("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_types');
    }
};
