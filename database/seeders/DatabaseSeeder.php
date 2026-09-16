<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Contact::factory(10)->create();

        $this->call([
            SettingSeeder::class,
            LanguageSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TermSeeder::class,
            PostSeeder::class,
            BanglaDummyContentSeeder::class,
            MenuSeeder::class,
            MenuItemSeeder::class,
            ThemeSeeder::class,
        ]);
    }
}
