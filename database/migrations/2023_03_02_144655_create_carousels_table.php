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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('page', 50);
            $table->string('position', 50);
            $table->boolean('fade')->default(false);
            $table->boolean('autoplay')->default(true);
            $table->smallInteger('interval')->default(10);
            $table->boolean('indicators')->default(false);
            $table->boolean('controls')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
