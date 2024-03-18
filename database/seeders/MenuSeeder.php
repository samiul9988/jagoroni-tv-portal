<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'name' => 'Header Menu'
        ])->languages()->sync([1, 2, 3]);

        Menu::create([
            'name' => 'Footer Menu'
        ])->languages()->sync([1, 2, 3]);
    }
}
