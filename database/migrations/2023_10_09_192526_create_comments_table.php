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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->enum('subscribe', ['y', 'n'])->default('y');
            $table->text('url')->nullable();
            $table->text('comment');
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('reply_id')->default(0);
            $table->integer('main_reply')->default(0);
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
            $table->enum('status', ['pending', 'approved'])->default('approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
