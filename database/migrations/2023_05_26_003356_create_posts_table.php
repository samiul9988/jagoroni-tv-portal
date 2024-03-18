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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('post_title');
            $table->text('post_name');
            $table->text('post_summary')->nullable();
            $table->longText('post_content')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('post_status')->default('publish');
            $table->string('post_visibility')->default('public');
            $table->unsignedBigInteger('post_author');
            $table->foreign('post_author')->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('post_language');
            $table->foreign('post_language')->references('id')->on('languages')
                ->onDelete('cascade');
            $table->string('post_type');
            $table->string('post_guid')->nullable();
            $table->unsignedBigInteger('post_hits')->default('0');
            $table->unsignedBigInteger('like')->default('0');
            $table->text('post_image')->nullable();
            $table->text('post_image_meta')->nullable();
            $table->string('post_mime_type')->default('');
            $table->enum('comment_status', ['open','closed'])->default ('open');
            $table->unsignedBigInteger('comment_count')->default('0');
            $table->text('post_source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
