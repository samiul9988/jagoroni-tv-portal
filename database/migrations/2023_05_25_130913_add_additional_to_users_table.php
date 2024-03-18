<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('email_verified_at')->nullable();
            $table->string('photo')->nullable();
            $table->string('about')->nullable();
            $table->longText('links')->nullable();
            $table->string('occupation')->nullable();
            $table->unsignedBigInteger('language');
            $table->foreign('language')->references('id')->on('languages')
                ->onDelete('cascade');
            $table->string('darkmode')->default(0);
            $table->enum('active', [1, 0])->default(1);
            $table->timestamp('banned_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('photo');
            $table->dropColumn('about');
            $table->dropColumn('links');
            $table->dropColumn('occupation');
            $table->dropForeign(['language']);
            $table->dropColumn('language');
            $table->dropColumn('darkmode');
            $table->dropColumn('active');
            $table->dropColumn('banned_at');

        });
    }
};
