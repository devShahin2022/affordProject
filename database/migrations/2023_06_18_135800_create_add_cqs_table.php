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
        Schema::create('add_cqs', function (Blueprint $table) {
            $table->id();

            $table->string('departmentName');
            $table->string('subjectName');
            $table->string('chapterName');
            $table->string('questionCat');
            $table->string('boardOrSchoolName')->nullable();
            $table->string('year')->nullable();
            $table->string('uddipakPhoto')->nullable();
            $table->text('uddipakText');
            $table->text('question1');
            $table->text('question2');
            $table->text('question3');
            $table->text('question4')->nullable();
            $table->string('answerPhoto1')->nullable();
            $table->string('answerPhoto2')->nullable();
            $table->string('answerPhoto3')->nullable();
            $table->string('answerPhoto4')->nullable();
            $table->text('answerQuestion1')->nullable();
            $table->text('answerQuestion2')->nullable();
            $table->text('answerQuestion3')->nullable();
            $table->text('answerQuestion4')->nullable();
            $table->string('status')->default(1);
            $table->string('isReport')->default(0);
            $table->string('reportReply')->nullable();
            $table->string('reporterId')->nullable();
            $table->string('addedBy')->nullable();
            $table->string('replyBy')->nullable();
            $table->string('maxCqCapcity')->nullable();
            $table->string('isXmQuestion')->default(0);
            $table->string('setNo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_cqs');
    }
};
