<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intensitas', function (Blueprint $table) {
            $table->id(); // id : int
            $table->unsignedBigInteger('user_id'); // user_id : int
            $table->enum('gender', ['Laki-laki', 'Perempuan']); // gender : enum
            $table->integer('age'); // age : int
            $table->float('weight_kg'); // weight_kg : float
            $table->float('height_cm'); // height_cm : float
            $table->enum('activity_level', ['Ringan', 'Sedang', 'Berat']); // activity_level : enum
            $table->timestamps(); // created_at dan updated_at

            // Foreign key opsional jika relasi ke users
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intensitas');
    }
};
