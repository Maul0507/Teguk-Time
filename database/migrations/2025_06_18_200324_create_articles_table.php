<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // id : int
            $table->string('title', 200); // title : varchar(200)
            $table->text('content'); // content : text
            $table->string('image_url', 255); // image_url : varchar(255)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
