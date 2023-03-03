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
        Schema::create('thematic_images', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('position')->default(1);
            $table->integer('thematic_id')->unsigned();
            $table->string('image_path');
            $table->string('title', 50)->nullable();
            $table->string('description', 150)->nullable();
            $table->foreign('thematic_id')->references('id')->on('thematics')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thematic_images');
    }
};
