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
        Schema::create('question_models', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('user_id');
            $table->string('question_img')->nullable();
            $table->string('answer')->nullable();
            $table->string('reply_teacher_id')->nullable();
            $table->string('reply_img')->nullable();
            $table->string('status'); // o=> mean pending , 1=> mean answered
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_models');
    }
};
