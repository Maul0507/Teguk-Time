<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('intensitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('jenis_kelamin');
            $table->integer('umur');
            $table->double('berat_badan');
            $table->double('tinggi_badan');
            $table->string('aktivitas');
            $table->double('target_air');
            $table->date('tanggal');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('intensitas');
    }
};
