<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_leader')->default(false)->index();
            $table->string('quote', 500)->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('experience')->nullable();
            $table->string('location')->nullable();
            $table->string('motto')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        // Add the "Our Team" item to the header menu of every language that already has one.
        if (Schema::hasTable('menu_items')) {
            $items = DB::table('menu_items')->where('menu_id', 1)->where('parent', 0);
            $languages = (clone $items)->distinct()->pluck('language');
            foreach ($languages as $language) {
                if (DB::table('menu_items')->where('menu_id', 1)->where('language', $language)->where('link', '/team')->exists()) {
                    continue;
                }
                DB::table('menu_items')->insert([
                    'label' => 'আমাদের টিম',
                    'link' => '/team',
                    'parent' => 0,
                    'sort' => (int) DB::table('menu_items')->where('menu_id', 1)->where('language', $language)->where('parent', 0)->max('sort') + 1,
                    'class' => null,
                    'menu_id' => 1,
                    'language' => $language,
                    'depth' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('menu_items')->where('link', '/team')->delete();
        Schema::dropIfExists('team_members');
    }
};
