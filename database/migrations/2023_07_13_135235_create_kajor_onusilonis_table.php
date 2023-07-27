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
        Schema::create('kajor_onusilonis', function (Blueprint $table) {
            $table->id();
            $table->string("departmentName");
            $table->string("subjectName");
            $table->string("chapterName");
            $table->string("onusiloni")->nullable();
            $table->string("kajNo")->nullable();
            $table->string("questionImg")->nullable();
            $table->text("question");
            $table->string("answerImg")->nullable();
            $table->text("answer")->nullable();
            $table->string("justAnswer")->nullable();
            $table->string("type");
            $table->string("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajor_onusilonis');
    }
};
