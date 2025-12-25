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
        Schema::create('donasi_offlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('nama_donatur');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('kanal')->nullable(); // contoh: kasir, bazar, kotak amal
            $table->integer('nominal');
            $table->boolean('notif')->default(false);
            $table->date('tanggal_bayar')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_offlines');
    }
};
