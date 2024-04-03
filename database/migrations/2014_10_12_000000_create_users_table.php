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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('team')->nullable();
            $table->integer('skor')->default(0);
            $table->text('foto')->nullable();
            $table->string('wa')->nullable();
            $table->string('gender')->nullable();
            $table->string('sekolah')->nullable();
            $table->string('status')->nullable();
            $table->string('instagram')->nullable();
            $table->text('kata_mutiara')->nullable();
            $table->rememberToken();
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
