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
        Schema::create('hasil_tugas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tugas_id');
        $table->string('link_hasil')->nullable();
        $table->text('deskripsi');
        $table->timestamps();

        // Menambahkan foreign key constraint untuk tugas_id
        $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_tugas');
    }
};
