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
            $table->string('question_cat');
            $table->string('question_type');
            $table->string('year')->nullable();
            $table->string('Board_name')->nullable();
            $table->string('uddipak')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('question');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4')->nullable();
            $table->string('answer');
            $table->string('explain')->nullable();
            $table->string('question_link_id')->nullable();
            $table->string('uploaded_by');
            $table->string('status');
            $table->string('similar_question')->nullable();
            $table->string('video_link')->nullable();
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
