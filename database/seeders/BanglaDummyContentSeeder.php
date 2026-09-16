<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Term;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BanglaDummyContentSeeder extends Seeder
{
    /**
     * Seed a reusable Bengali demo news desk without removing existing content.
     */
    public function run(): void
    {
        $authorId = DB::table('users')->value('id');
        $languageId = DB::table('languages')->where('language', 'en')->value('id') ?: DB::table('languages')->value('id');

        if (!$authorId || !$languageId) {
            $this->command?->warn('Bangla demo content skipped: no author or language was found.');
            return;
        }

        $categories = [
            'জাতীয়' => 'jatiyo',
            'রাজনীতি' => 'rajniti',
            'সারাদেশ' => 'saradesh',
            'আন্তর্জাতিক' => 'antorjatik',
            'খেলাধুলা' => 'kheladhula',
            'বিনোদন' => 'binodon',
            'প্রযুক্তি' => 'projukti',
            'স্বাস্থ্য' => 'swasthya',
        ];

        $categoryTerms = [];
        foreach ($categories as $name => $slug) {
            $categoryTerms[$name] = Term::firstOrCreate(
                ['slug' => $slug, 'language_id' => $languageId, 'taxonomy' => 'category'],
                ['name' => $name, 'image' => 'category-news.jpg', 'translation' => null]
            );
        }

        $stories = [
            ['জাতীয়', 'দেশজুড়ে উন্নয়ন প্রকল্পে নতুন গতি, নাগরিক সেবায় আসছে আরও স্বচ্ছতা', 'দেশের বিভিন্ন অঞ্চলে চলমান উন্নয়ন প্রকল্পগুলোর কাজ দ্রুত শেষ করতে নতুন কর্মপরিকল্পনা নেওয়া হয়েছে। সংশ্লিষ্টরা বলছেন, এতে নাগরিক সেবা আরও সহজ ও দ্রুত হবে।', 'bangla-news-national.svg'],
            ['জাতীয়', 'শিক্ষার্থীদের জন্য আধুনিক পাঠাগার গড়তে বিশেষ উদ্যোগ', 'শিক্ষাপ্রতিষ্ঠানে পাঠাভ্যাস বাড়াতে দেশের বিভিন্ন এলাকায় আধুনিক পাঠাগার ও ডিজিটাল রিডিং কর্নার চালুর উদ্যোগ নেওয়া হয়েছে।', 'bangla-news-education.svg'],
            ['রাজনীতি', 'সংসদীয় কমিটির বৈঠকে জনস্বার্থের একাধিক প্রস্তাব নিয়ে আলোচনা', 'জনগণের প্রত্যাশা পূরণে সেবার মান বাড়ানো এবং স্থানীয় পর্যায়ে জবাবদিহিতা নিশ্চিত করার বিষয়ে বৈঠকে গুরুত্ব দেওয়া হয়েছে।', 'bangla-news-politics.svg'],
            ['রাজনীতি', 'নির্বাচনী সংস্কার নিয়ে মতবিনিময় সভা অনুষ্ঠিত', 'গণতান্ত্রিক প্রতিষ্ঠান শক্তিশালী করতে অংশীজনদের নিয়ে আয়োজিত মতবিনিময় সভায় বিভিন্ন সুপারিশ তুলে ধরা হয়েছে।', 'bangla-news-politics.svg'],
            ['সারাদেশ', 'সড়ক নিরাপত্তায় জেলা শহরগুলোতে শুরু হয়েছে সচেতনতামূলক অভিযান', 'সড়কে শৃঙ্খলা ফেরাতে চালক, পথচারী ও শিক্ষার্থীদের নিয়ে সচেতনতামূলক কর্মসূচি আয়োজন করছে স্থানীয় প্রশাসন।', 'bangla-news-national.svg'],
            ['সারাদেশ', 'উপকূলীয় এলাকায় দুর্যোগ প্রস্তুতিতে স্বেচ্ছাসেবকদের প্রশিক্ষণ', 'দুর্যোগের সময় দ্রুত সহায়তা পৌঁছে দিতে উপকূলের বিভিন্ন এলাকায় স্বেচ্ছাসেবকদের প্রশিক্ষণ দেওয়া হচ্ছে।', 'bangla-news-national.svg'],
            ['আন্তর্জাতিক', 'জলবায়ু পরিবর্তন মোকাবিলায় আঞ্চলিক সহযোগিতার আহ্বান', 'পরিবেশ রক্ষা ও দুর্যোগের ক্ষতি কমাতে দেশগুলোর মধ্যে তথ্য ও প্রযুক্তি বিনিময়ের ওপর গুরুত্ব দিয়েছেন বিশেষজ্ঞরা।', 'bangla-news-world.svg'],
            ['আন্তর্জাতিক', 'ডিজিটাল অর্থনীতিতে দক্ষতা উন্নয়নে নতুন অংশীদারত্ব', 'তরুণদের কর্মসংস্থান বাড়াতে প্রযুক্তিনির্ভর প্রশিক্ষণ ও উদ্ভাবনী প্রকল্পে আন্তর্জাতিক সহযোগিতা জোরদারের কথা জানানো হয়েছে।', 'bangla-news-tech.svg'],
            ['খেলাধুলা', 'শেষ মুহূর্তের গোলে রোমাঞ্চকর জয় পেল সবুজ দল', 'প্রতিদ্বন্দ্বিতাপূর্ণ ম্যাচে শেষ মিনিটের গোলে জয় নিশ্চিত করেছে সবুজ দল। মাঠজুড়ে দর্শকদের মধ্যে ছিল উৎসবের আমেজ।', 'bangla-news-sports.svg'],
            ['খেলাধুলা', 'তরুণ ক্রিকেটারদের নিয়ে জাতীয় ক্যাম্পে নতুন পরিকল্পনা', 'আগামী মৌসুমকে সামনে রেখে প্রতিভাবান তরুণ ক্রিকেটারদের নিয়ে দীর্ঘমেয়াদি অনুশীলন পরিকল্পনা তৈরি করেছে কোচিং স্টাফ।', 'bangla-news-sports.svg'],
            ['বিনোদন', 'নতুন চলচ্চিত্রে উঠে আসছে বাংলার মানুষের গল্প', 'সমাজ ও মানুষের সম্পর্কের গল্প নিয়ে নির্মিত নতুন চলচ্চিত্রটি শিগগিরই প্রেক্ষাগৃহে মুক্তি পাবে বলে জানিয়েছেন নির্মাতা।', 'bangla-news-entertainment.svg'],
            ['বিনোদন', 'দেশীয় সংগীতাঙ্গনে তরুণ শিল্পীদের নতুন আয়োজন', 'নতুন প্রজন্মের শিল্পীদের পরিবেশনায় আয়োজিত সংগীত সন্ধ্যায় দর্শকদের জন্য থাকছে নানা ঘরানার গান।', 'bangla-news-entertainment.svg'],
            ['প্রযুক্তি', 'দেশে তৈরি স্মার্ট সেবা প্ল্যাটফর্মে একসঙ্গে মিলবে নাগরিক সুবিধা', 'একটি নতুন ডিজিটাল প্ল্যাটফর্মে সরকারি ও বেসরকারি কয়েকটি সেবা যুক্ত করার কাজ চলছে। এতে সময় ও খরচ দুটোই কমবে বলে আশা করা হচ্ছে।', 'bangla-news-tech.svg'],
            ['প্রযুক্তি', 'সাইবার নিরাপত্তায় সচেতনতা বাড়াতে শিক্ষাপ্রতিষ্ঠানে কর্মশালা', 'নিরাপদ ইন্টারনেট ব্যবহার, তথ্য সুরক্ষা ও অনলাইন প্রতারণা প্রতিরোধে শিক্ষার্থীদের জন্য কর্মশালা আয়োজন করা হয়েছে।', 'bangla-news-tech.svg'],
            ['স্বাস্থ্য', 'কমিউনিটি ক্লিনিকে বাড়ছে প্রাথমিক স্বাস্থ্যসেবা', 'গ্রাম ও শহরতলির মানুষের কাছে সহজে স্বাস্থ্যসেবা পৌঁছে দিতে কমিউনিটি ক্লিনিকগুলোতে নতুন সেবা যুক্ত করা হচ্ছে।', 'bangla-news-health.svg'],
            ['স্বাস্থ্য', 'সুস্থ থাকতে নিয়মিত হাঁটার পরামর্শ বিশেষজ্ঞদের', 'শরীর সুস্থ রাখতে প্রতিদিন নিয়মিত হাঁটা, পরিমিত খাবার ও পর্যাপ্ত ঘুমের অভ্যাস গড়ে তোলার পরামর্শ দিয়েছেন চিকিৎসকরা।', 'bangla-news-health.svg'],
        ];

        foreach ($stories as $index => [$category, $title, $summary, $image]) {
            $slug = 'demo-bangla-' . Str::slug($category) . '-' . ($index + 1);
            $post = Post::updateOrCreate(
                ['post_name' => $slug],
                [
                    'post_title' => $title,
                    'post_summary' => '<p>' . e($summary) . '</p>',
                    'post_content' => '<p>' . e($summary) . '</p><p>জাগরণী টিভির ডেমো নিউজ ডেস্কের এই প্রতিবেদনটি ওয়েবসাইটের লেআউট ও কনটেন্ট প্রদর্শনের জন্য তৈরি করা হয়েছে।</p>',
                    'post_image' => $image,
                    'post_author' => $authorId,
                    'post_language' => $languageId,
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'post_visibility' => 'public',
                    'post_hits' => 10 + $index,
                    'like' => 2 + $index,
                    'meta_description' => $summary,
                    'meta_keyword' => $category . ', জাগরণী টিভি, বাংলা সংবাদ',
                    'created_at' => now()->subMinutes($index * 11),
                    'updated_at' => now(),
                ]
            );
            $post->terms()->sync([$categoryTerms[$category]->id]);
        }

        foreach ([
            ['প্রযুক্তি', 'ভিডিও: স্মার্ট বাংলাদেশে নতুন ডিজিটাল সেবার সম্ভাবনা', 'bangla-news-tech.svg'],
            ['খেলাধুলা', 'ভিডিও: ম্যাচ জয়ের পর খেলোয়াড়দের উচ্ছ্বাস', 'bangla-news-sports.svg'],
            ['বিনোদন', 'ভিডিও: নতুন সিনেমা নিয়ে নির্মাতার বিশেষ সাক্ষাৎকার', 'bangla-news-entertainment.svg'],
        ] as $index => [$category, $title, $image]) {
            $slug = 'demo-bangla-video-' . ($index + 1);
            $post = Post::updateOrCreate(
                ['post_name' => $slug],
                [
                    'post_title' => $title,
                    'post_summary' => '<p>জাগরণী টিভির বিশেষ ভিডিও প্রতিবেদন।</p>',
                    'post_content' => '<p>জাগরণী টিভির ডেমো ভিডিও কনটেন্ট।</p>',
                    'post_image' => $image,
                    'post_author' => $authorId,
                    'post_language' => $languageId,
                    'post_type' => 'video_url',
                    'post_guid' => 'https://www.youtube.com/watch?v=demo' . ($index + 1),
                    'post_status' => 'publish',
                    'post_visibility' => 'public',
                    'created_at' => now()->subMinutes(200 + $index),
                    'updated_at' => now(),
                ]
            );
            $post->terms()->sync([$categoryTerms[$category]->id]);
        }

        $this->command?->info('Bengali demo news, categories, videos, and local thumbnails are ready.');
    }
}
