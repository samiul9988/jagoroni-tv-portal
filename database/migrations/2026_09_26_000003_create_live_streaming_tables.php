<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('জাগরণী টিভি লাইভ');
            $table->string('stream_type')->default('youtube'); // youtube, facebook, hls, mp4, embed
            $table->string('stream_url', 2048)->nullable();
            $table->longText('embed_code')->nullable();
            $table->string('poster')->nullable();
            $table->string('viewers_label')->nullable();
            $table->string('youtube_url', 2048)->nullable();
            $table->string('facebook_url', 2048)->nullable();
            $table->string('website_url', 2048)->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_text')->nullable();
            $table->boolean('is_live')->default(true);
            $table->timestamps();
        });

        Schema::create('live_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        if (Schema::hasTable('menu_items')) {
            $languages = DB::table('menu_items')->where('menu_id', 1)->where('parent', 0)->distinct()->pluck('language');
            foreach ($languages as $language) {
                if (DB::table('menu_items')->where('menu_id', 1)->where('language', $language)->where('link', '/live-tv')->exists()) {
                    continue;
                }
                DB::table('menu_items')->insert([
                    'label' => 'লাইভ স্ট্রিমিং',
                    'link' => '/live-tv',
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
        DB::table('menu_items')->where('link', '/live-tv')->delete();
        Schema::dropIfExists('live_programs');
        Schema::dropIfExists('live_streams');
    }
};
