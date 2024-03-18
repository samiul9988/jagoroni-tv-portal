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
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('slug')->nullable();
            $table->string('taxonomy');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('parent')->default(0);
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')
                ->onDelete('cascade');
            $table->text('translation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
