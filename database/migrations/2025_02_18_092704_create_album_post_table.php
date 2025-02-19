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
        Schema::create('album_post', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('post_id')->constrained('posts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('album_id')->constrained('albums')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_post');
    }
};
