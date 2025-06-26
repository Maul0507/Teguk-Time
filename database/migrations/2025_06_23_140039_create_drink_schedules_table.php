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
        Schema::create('drink_schedules', function (Blueprint $table) {
            $table->id(); // id : int
            $table->unsignedBigInteger('user_id'); // user_id : int
            $table->time('schedule_time'); // schedule_time : time
            $table->integer('volume_ml'); // volume_ml : int
            $table->timestamps(); // created_at dan updated_at

            // Tambahkan foreign key ke users jika ada relasi
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_schedules');
    }
};
