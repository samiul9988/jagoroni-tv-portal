<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_items')->insertOrIgnore([
            // header
            // english
            [
                'id' => 1,
                'label' => 'Home',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'label' => 'News',
                'link' => '/category/news',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'label' => 'Tech',
                'link' => '/category/technology',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'label' => 'Lifestyle',
                'link' => '/category/lifestyle',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'label' => 'Sport',
                'link' => '/category/sport',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'label' => 'Medical',
                'link' => '/category/medical',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'label' => 'Video',
                'link' => '/videos/latest',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'label' => 'About',
                'link' => '/page/about',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'label' => 'About Us',
                'link' => '/page/about',
                'parent' => 8,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'label' => 'Privacy Policy',
                'link' => '/page/privacy-policy',
                'parent' => 8,
                'sort' => 1,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'label' => 'Terms & Conditions',
                'link' => '/page/terms-conditions',
                'parent' => 8,
                'sort' => 2,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'label' => 'Contact',
                'link' => '/contact',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // header
            // indonesia

            [
                'id' => 13,
                'label' => 'Beranda',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'label' => 'Berita',
                'link' => '/category/berita',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'label' => 'Teknologi',
                'link' => '/category/teknologi',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'label' => 'Gaya Hidup',
                'link' => '/category/gaya-hidup',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'label' => 'Olahraga',
                'link' => '/category/olahraga',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 18,
                'label' => 'Medis',
                'link' => '/category/medis',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 19,
                'label' => 'Video',
                'link' => '/video/latest',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 20,
                'label' => 'Tentang',
                'link' => '#',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 21,
                'label' => 'Tentang Kami',
                'link' => '/page/tentang',
                'parent' => 20,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 22,
                'label' => 'Kebijakan Privasi',
                'link' => '/page/kebijakan-privasi',
                'parent' => 20,
                'sort' => 1,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 23,
                'label' => 'Syarat & Ketentuan',
                'link' => '/page/syarat-ketentuan',
                'parent' => 20,
                'sort' => 2,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 24,
                'label' => 'Kontak',
                'link' => '/kontak',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // header
            // arabic

            [
                'id' => 25,
                'label' => 'مسكن',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 26,
                'label' => 'أخبار',
                'link' => '/category/akhb-r',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 27,
                'label' => 'تكنولوجيا',
                'link' => '/category/tknology',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 28,
                'label' => 'أسلوب الحياة',
                'link' => '/category/aslob-lhy',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 29,
                'label' => 'رياضة',
                'link' => '/category/ry-d',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 30,
                'label' => 'طبي',
                'link' => '/category/tby',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 31,
                'label' => 'فيديو',
                'link' => '/fydyo/latest',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 32,
                'label' => 'عن',
                'link' => '#',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 33,
                'label' => 'عن',
                'link' => '/page/aan',
                'parent' => 32,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 34,
                'label' => 'سياسة الخصوصية',
                'link' => '/page/sy-s-lkhsosy',
                'parent' => 32,
                'sort' => 1,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 35,
                'label' => 'البنود و الظروف',
                'link' => '/page/lbnod-o-lthrof',
                'parent' => 32,
                'sort' => 2,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 36,
                'label' => 'اتصال',
                'link' => '/ts-l',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 1,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],


            // footer
            // english

            [
                'id' => 37,
                'label' => 'Home',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 38,
                'label' => 'About',
                'link' => '/page/about',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 39,
                'label' => 'Privacy Policy',
                'link' => '/page/privacy-policy',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 40,
                'label' => 'Terms & Conditions',
                'link' => '/page/terms-conditions',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 1,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // footer
            // indonesia

            [
                'id' => 41,
                'label' => 'Beranda',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 42,
                'label' => 'Tentang',
                'link' => '/page/tentang',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 43,
                'label' => 'Kebijakan Privasi',
                'link' => '/page/kebijakan-privasi',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 44,
                'label' => 'Syarat & Ketentuan',
                'link' => '/page/syarat-ketentuan',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 2,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            // footer
            // arabic

            [
                'id' => 45,
                'label' => 'مسكن',
                'link' => '/',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 46,
                'label' => 'حول',
                'link' => '/page/hol',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 47,
                'label' => 'سياسة الخصوصية',
                'link' => '/page/sy-s-lkhsosy',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 48,
                'label' => 'البنود و الظروف',
                'link' => '/page/lbnod-o-lthrof',
                'parent' => 0,
                'sort' => 0,
                'menu_id' => 2,
                'language' => 3,
                'depth' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
