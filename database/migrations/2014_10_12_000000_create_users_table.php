<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('role');
            $table->string('departmentName');
            $table->string('photo_url')->nullable();
            $table->string('full_name')->nullable();
            $table->string('privilige')->nullable();
            $table->string('email')->nullable();
            $table->string('status');
            $table->string('account_type'); //pending request=>  0 mean=> basic account, 1 mean => premium account, 2 mean=> admission sscExamBatch, 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
