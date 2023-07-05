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
        Schema::create('upload_laws', function (Blueprint $table) {
            $table->id();
            $table->string("departmentName");
            $table->string("subjectName");
            $table->string("chapterName");
            $table->string("law");
            $table->string("lawExplain")->nullable();
            $table->string("example")->nullable();
            $table->string("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_laws');
    }
};
