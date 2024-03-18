<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'language' => 'en',
            'country' => 'United States',
            'country_code' =>'US',
            'direction' =>'ltr',
            'active' => 'y'
        ]);

        Language::create([
            'name' => 'Bahasa Indonesia',
            'language' => 'id',
            'country' => 'Indonesia',
            'country_code' =>'ID',
            'direction' =>'ltr',
            'active' => 'y'
        ]);

        Language::create([
            'name' => 'Arabic',
            'language' => 'ar',
            'country' => 'Saudi Arabia',
            'country_code' =>'SA',
            'direction' =>'rtl',
            'active' => 'y'
        ]);

        $dataArr = [
            [
                'en' => [
                    'name' => 'English',
                    'script' => 'Latin',
                    'native' => 'English',
                    'regional' => 'en_US'
                ]
            ],
            [
                'id' => [
                    'name' => 'Indonesian',
                    'script' => 'Latin',
                    'native' => 'Bahasa Indonesia',
                    'regional' => 'id_ID'
                ]
            ],
            [
                'ar' => [
                    'name' => 'Arabic',
                    'script' => 'Arab',
                    'native' => 'Arabic',
                    'regional' => 'ar_SA'
                ]
            ]
        ];

        $dataJson = json_encode(Arr::collapse($dataArr), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        File::put(storage_path('app/public/file/supportedLocales.json'), trim($dataJson, '[]'));
    }
}
