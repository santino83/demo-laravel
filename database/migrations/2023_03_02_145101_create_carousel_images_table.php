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
        Schema::create('carousel_images', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('interval')->default(0);
            $table->smallInteger('position')->default(1);
            $table->integer('carousel_id')->unsigned();
            $table->string('image_path');
            $table->string('title', 50)->nullable();
            $table->string('description', 150)->nullable();
            $table->foreign('carousel_id')->references('id')->on('carousels')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_images');
    }
};
