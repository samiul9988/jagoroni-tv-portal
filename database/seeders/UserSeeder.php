<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mark Otto

        $superAdmin = User::create([
            'name'       => 'Mark Otto',
            'username'   => 'superadmin',
            'email'      => 'superadmin@jagoroni.com',
            'password'   => Hash::make('superadmin123'),
            'occupation' => 'Website Manager',
            'photo'      => 'mark-otto.jpg',
            'about'      => 'I am a web artisan',
            'language'   => 1,
            'links'      => '[{"id":1,"label":"Facebook","url":"https://www.facebook.com/markotto","icon":"fa-brands fa-facebook","color":"#395693"},{"id":2,"label":"Twitter","url":"https://www.twitter.com/markotto","icon":"fa-brands fa-x-twitter","color":"#0051B3"},{"id":3,"label":"Youtube","url":"https://www.youtube.com/c/markotto","icon":"fab fa-youtube","color":"#C4302B"},{"id":4,"label":"Instagram","url":"https://www.instagram.com/markotto","icon":"fab fa-instagram","color":"#885343"}]'
        ])->assignRole('super-admin');

        // John Doe

        $admin = User::create([
            'name'       => 'John Doe',
            'username'   => 'admin',
            'email'      => 'admin@retenvi.com',
            'password'   => Hash::make('admin123'),
            'occupation' => 'Content creator',
            'photo'      => 'john-doe.jpg',
            'about'      => 'Someone who likes to write and teach',
            'language'   => 1,
            'links'      => '[{"id":1,"label":"Facebook","url":"https://www.facebook.com/johndoe","icon":"fa-brands fa-facebook","color":"#395693"},{"id":2,"label":"Twitter","url":"https://www.twitter.com/johndoe","icon":"fa-brands fa-x-twitter","color":"#0051B3"},{"id":3,"label":"Youtube","url":"https://www.youtube.com/c/johndoe","icon":"fab fa-youtube","color":"#C4302B"},{"id":4,"label":"Instagram","url":"https://www.instagram.com/johndoe","icon":"fab fa-instagram","color":"#885343"}]',
        ])->assignRole('admin');

        // Jacob Thornton

        User::create([
            'name'       => 'Jacob Thornton',
            'username'   => 'author',
            'email'      => 'author@retenvi.com',
            'password'   => Hash::make('author123'),
            'occupation' => 'Freelancer',
            'photo'      => 'jacob-thornton.jpg',
            'about'      => 'Hi I am Jacob',
            'language'   => 1,
        ])->assignRole('author');
    }
}
