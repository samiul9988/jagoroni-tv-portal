<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cache::forget('settings');

        Setting::create(['group' => 'site_information', 'key' => 'company_name', 'value' => 'jagoronitv']);
        Setting::create(['group' => 'site_information', 'key' => 'site_name', 'value' => 'jagoronitv']);
        Setting::create(['group' => 'site_information', 'key' => 'site_url', 'value' => 'http://localhost:8000']);
        Setting::create(['group' => 'site_information', 'key' => 'site_email', 'value' => 'example@mail.com']);
        Setting::create(['group' => 'site_information', 'key' => 'site_phone', 'value' => fake('en_US')->phoneNumber()]);
        Setting::create(['group' => 'site_information', 'key' => 'street', 'value' => '2711 Bicetown Road']);
        Setting::create(['group' => 'site_information', 'key' => 'city', 'value' => 'Huntington']);
        Setting::create(['group' => 'site_information', 'key' => 'postal_code', 'value' => '11743']);
        Setting::create(['group' => 'site_information', 'key' => 'state', 'value' => 'New York']);
        Setting::create(['group' => 'site_information', 'key' => 'country', 'value' => 'United States']);
        Setting::create(['group' => 'site_information', 'key' => 'site_description', 'value' => 'jagoronitv is a Content Management System (CMS) built on the Laravel framework']);
        Setting::create(['group' => 'site_information', 'key' => 'contact_description', 
                'value' => json_encode([
                    'id' => "Hubungi kami dengan mudah untuk pertanyaan, informasi tambahan, atau untuk terhubung langsung dengan tim kami. Kami di sini untuk membantu Anda dengan layanan terbaik. Jangan ragu untuk mengirim pesan, email kepada kami, atau menghubungi melalui saluran media sosial kami. Kami menantikan kabar dari Anda!",
                    'en' => "Get in touch effortlessly for inquiries, additional information, or to connect directly with our team. We're here to assist you with the best service possible. Feel free to send a message, email us, or reach out through our social media channels. We look forward to hearing from you!",
                    'ar' => "تواصل معنا بسهولة للاستفسارات أو المعلومات الإضافية أو للتواصل مباشرة مع فريقنا. نحن هنا لمساعدتك بأفضل خدمة ممكنة. لا تتردد في إرسال رسالة أو مراسلتنا عبر البريد الإلكتروني أو التواصل عبر قنوات التواصل الاجتماعي الخاصة بنا. نحن نتطلع الى الاستماع منك!"
                ])
        ]);
        Setting::create(['group' => 'site_information', 'key' => 'meta_keyword', 'value' => 'website, news, laravel, php, cms']);
        Setting::create(['group' => 'site_information', 'key' => 'links', 'value' => '[{"id":"1","name":"Instagram","url":"https://www.instagram.com/retenvi","icon":"fab fa-instagram","color":"#885343"},{"id":"2","name":"Youtube","url":"https://www.youtube.com/channel/UCUYm8eLTfJDyHSHBLgFU5Gg","icon":"fab fa-youtube","color":"#C4302B"}]']);
        Setting::create(['group' => 'site_information', 'key' => 'version', 'value' => '2.3.1']);
        Setting::create(['group' => 'site_config', 'key' => 'maintenance', 'value' => 'n']);
        Setting::create(['group' => 'site_config', 'key' => 'current_theme', 'value' => 'magz']);
        Setting::create(['group' => 'site_config', 'key' => 'current_theme_dir', 'value' => 'magz']);
        Setting::create(['group' => 'site_config', 'key' => 'register', 'value' => 'n']);
        Setting::create(['group' => 'site_config', 'key' => 'email_verification', 'value' => 'n']);
        Setting::create(['group' => 'site_config', 'key' => 'display_language', 'value' => 'y']);
        Setting::create(['group' => 'site_config', 'key' => 'default_language', 'value' => 'en']);
        Setting::create(['group' => 'site_config', 'key' => 'credentials_file', 'value' => 'service-account-credentials.json']);
        Setting::create(['group' => 'site_config', 'key' => 'disqus_shortname', 'value' => '']);
        Setting::create(['group' => 'site_config', 'key' => 'mailchimp', 'value' => '']);
        Setting::create(['group' => 'site_config', 'key' => 'comment_approval', 'value' => 'n']);
        Setting::create(['group' => 'site_config', 'key' => 'number_nested_comments', 'value' => '5']);
        Setting::create(['group' => 'site_config', 'key' => 'send_comment_reply_email', 'value' => 'n']);
        Setting::create(['group' => 'logo_image', 'key' => 'favicon', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'logo_web_light', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'logo_web_dark', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_homepage', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_category', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_contact', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_page', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_popular_post', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_posts', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_search', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_article_post', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_video_post', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_audio_post', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'ogi_tag', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'logo_dashboard', 'value' => '']);
        Setting::create(['group' => 'logo_image', 'key' => 'logo_auth', 'value' => '']);
        Setting::create(['group' => 'google', 'key' => 'measurement_id', 'value' => '']);
        Setting::create(['group' => 'google', 'key' => 'property_id', 'value' => '']);
        Setting::create(['group' => 'google', 'key' => 'publisher_id', 'value' => '']);
        Setting::create(['group' => 'google', 'key' => 'google_site_verification', 'value' => '']);
        Setting::create(['group' => 'permalinks', 'key' => 'permalink_type', 'value' => 'custom']);
        Setting::create(['group' => 'permalinks', 'key' => 'permalink', 'value' => 'news']);
        Setting::create(['group' => 'permalinks', 'key' => 'permalink_old_custom', 'value' => 'news']);
        Setting::create(['group' => 'permalinks', 'key' => 'page_permalink_type', 'value' => 'with_prefix']);
        Setting::create(['group' => 'permalinks', 'key' => 'category_permalink_type', 'value' => 'with_prefix_category']);
    }
}
