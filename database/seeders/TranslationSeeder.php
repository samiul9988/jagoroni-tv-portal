<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Translation::create([
            'value' => json_encode([
                'en' => 1,
                'id' => 15,
                'ar' => 25,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 2,
                'id' => 16,
                'ar' => 26,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 3,
                'id' => 17,
                'ar' => 27,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 4,
                'id' => 18,
                'ar' => 28,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 5,
                'id' => 19,
                'ar' => 29,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 6,
                'id' => 20,
                'ar' => 30,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 7,
                'id' => 21,
                'ar' => 31,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 8,
                'id' => 22,
                'ar' => 32,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 9,
                'id' => 23,
                'ar' => 33,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 10,
                'id' => 24,
                'ar' => 34,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 12
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 13
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 14
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 35,
                'id' => 37,
            ])
        ]);
        Translation::create([
            'value' => json_encode([
                'en' => 36,
                'id' => 38,
            ])
        ]);
    }
}
