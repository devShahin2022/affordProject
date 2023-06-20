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
        Schema::create('add_mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('departmentName');
            $table->string('subjectName');
            $table->string('chapterName');
            $table->string('questionCat');
            $table->string('boardOrSchoolName')->nullable(); 
            $table->string('year')->nullable();
            $table->string('question_type')->nullable();
            $table->text('uddipak')->nullable();
            $table->string('photo_url')->nullable();
            $table->text('question');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4')->nullable();
            $table->string('answer');
            $table->text('explain')->nullable();
            $table->string('uploaded_by');
            $table->string('status');
            $table->text('similar_question')->nullable();
            $table->string('isReport')->nullable();
            $table->string('reporter_msg')->nullable();
            $table->string('reply_report_msg')->nullable();
            $table->string('reply_report_msg_by')->nullable();
            $table->string('reporter_id')->nullable();
            $table->string('question_set')->nullable();
            $table->string('max_capacity')->nullable();
            $table->string('uploader_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_mcqs');
    }
};
