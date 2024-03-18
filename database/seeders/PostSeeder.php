<?php

namespace Database\Seeders;

use App\Helpers\PostHelper;
use App\Models\Post;
use App\Models\Translation;
use App\Traits\LanguageTrait;
use App\Traits\TermTrait;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    use LanguageTrait;
    use TermTrait;

    /**
     * Run the database seeds.
     */
    public function run()
    {

        # Post Translation Relations 1,2, 3
        Translation::create([
            'id' => 1,
            'value' => json_encode([
                'en' => 1,
                'id' => 2,
                'ar' => 3,
            ])
        ]);

        # 1
        $post = Post::create([
            "id" => 1,
            "post_title" => "Facebook Removes Trump Ad Over 'Nazi Hate Symbol'",
            "post_name" => "facebook-removes-trump-ad-over-nazi-hate-symbol",
            "post_summary" => html_entity_decode("&lt;p&gt;Facebook says it has removed adverts for US President Donald Trump&apos;s re-election campaign that featured a symbol used in Nazi Germany.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;The company said the offending ad contained an inverted red triangle similar to that used by the Nazis to label opponents such as communists.&lt;/p&gt;&lt;p&gt;Mr Trump&apos;s campaign team said they were aimed at the far-left activist group antifa, which it said uses the symbol.&lt;/p&gt;&lt;p&gt;Facebook said the ads violated its policy against organised hate.&lt;/p&gt;&lt;p&gt;&quot;We don&apos;t allow symbols that represent hateful organisations or hateful ideologies unless they are put up with context or condemnation,&quot; the social network&apos;s head of security policy, Nathaniel Gleicher, said on Thursday.&lt;/p&gt;&lt;p&gt;He added: &quot;That&apos;s what we saw in this case with this ad, and anywhere that that symbol is used we would take the same actions.&quot;&lt;/p&gt;&lt;p&gt;&lt;figure class=&quot;image&quot;&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/180D5/production/_112971589_hi062017586.jpg&quot; style=&quot;width: 624px; height: 396px;&quot; alt=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot; title=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot;&gt;&lt;figcaption class=&quot;captionClass&quot;&gt;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&lt;/figcaption&gt;&lt;/figure&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The ads, which were posted on the site on pages belonging to President Trump and Vice-President Mike Pence, were online for about 24 hours and had received hundreds of thousands of views before they were taken down.&lt;/p&gt;&lt;p&gt;&quot;The inverted red triangle is a symbol used by antifa, so it was included in an ad about antifa,&quot; Tim Murtaugh, a spokesman for the Trump campaign, said in a statement.&lt;/p&gt;&lt;p&gt;&quot;We would note that Facebook still has an inverted red triangle emoji in use, which looks exactly the same,&quot; he added.&lt;/p&gt;&lt;p&gt;Mr Trump has recently accused antifa of starting riots at street protests across the US over the death in police custody of African American George Floyd.&lt;/p&gt;&lt;p&gt;The president said last month that he would designate the anti-fascist group a &quot;domestic terrorist organisation&quot;, although legal experts have questioned his authority to do so.&lt;/p&gt;&lt;p&gt;Antifa is a far left protest movement that opposes neo-Nazis, fascism, white supremacists and racism. It is considered to be a loosely organised group of activists with no leaders.&lt;/p&gt;&lt;p&gt;Most members decry what they see as the nationalistic, anti-immigration and anti-Muslim policies of Mr Trump.&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image1.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:00",
            "updated_at" => "2022-06-12 00:00:00"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Social Media'),
        ]);
        $post->translations()->attach(1);

        # 15
        $post = Post::create([
            "id" => 2,
            "post_title" => "Facebook Hapus Iklan Trump Terkait 'Simbol Kebencian Nazi'",
            "post_name" => "facebook-hapus-iklan-trump-terkait-simbol-kebencian-nazi",
            "post_summary" => html_entity_decode("&lt;p&gt;Facebook mengatakan telah menghapus iklan untuk kampanye pemilihan ulang Presiden AS Donald Trump yang menampilkan simbol yang digunakan di Nazi Jerman.&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Perusahaan itu mengatakan iklan yang menyinggung berisi segitiga merah terbalik mirip dengan yang digunakan oleh Nazi untuk melabeli lawan seperti komunis.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Tim kampanye Trump mengatakan mereka ditujukan pada kelompok aktivis sayap kiri antifa, yang dikatakan menggunakan simbol tersebut.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Facebook mengatakan iklan tersebut melanggar kebijakannya terhadap kebencian terorganisir.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Kami tidak mengizinkan simbol yang mewakili organisasi kebencian atau ideologi kebencian kecuali jika mereka ditempatkan dengan konteks atau kecaman,&quot; kepala kebijakan keamanan jaringan sosial, Nathaniel Gleicher, mengatakan pada hari Kamis.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dia menambahkan: &quot;Itulah yang kami lihat dalam kasus ini dengan iklan ini, dan di mana pun simbol itu digunakan, kami akan mengambil tindakan yang sama.&quot;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;figure class=&quot;image&quot;&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/180D5/production/_112971589_hi062017586.jpg&quot; style=&quot;width: 624px; height: 396px;&quot; alt=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot; title=&quot;A screenshot showing the symbol used in a Trump campaign ad and removed from Facebook&quot;&gt;&lt;figcaption class=&quot;captionClass&quot;&gt;Tangkapan layar yang menunjukkan simbol yang digunakan dalam iklan kampanye Trump dan dihapus dari Facebook&lt;/figcaption&gt;&lt;/figure&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;Iklan, yang diposting di situs pada halaman milik Presiden Trump dan Wakil Presiden Mike Pence, online selama sekitar 24 jam dan telah menerima ratusan ribu tampilan sebelum dihapus.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Segitiga merah terbalik adalah simbol yang digunakan oleh antifa, sehingga dimasukkan dalam iklan tentang antifa,&quot; kata Tim Murtaugh, juru bicara kampanye Trump, dalam sebuah pernyataan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Kami akan mencatat bahwa Facebook masih menggunakan emoji segitiga merah terbalik, yang terlihat persis sama,&quot; tambahnya.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Trump baru-baru ini menuduh antifa memulai kerusuhan di protes jalanan di seluruh AS atas kematian George Floyd dalam tahanan polisi.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Presiden mengatakan bulan lalu bahwa dia akan menunjuk kelompok anti-fasis sebagai &quot;organisasi teroris domestik&quot;, meskipun para ahli hukum mempertanyakan wewenangnya untuk melakukannya.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Antifa adalah gerakan protes paling kiri yang menentang neo-Nazi, fasisme, supremasi kulit putih, dan rasisme. Ini dianggap sebagai kelompok aktivis yang terorganisir secara longgar tanpa pemimpin.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Sebagian besar anggota mengecam apa yang mereka lihat sebagai kebijakan nasionalistik, anti-imigrasi, dan anti-Muslim dari Trump.&lt;/span&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image1.jpg",
            "post_hits" => 3,
            "like" => 1,
            "created_at" => "2022-06-12 00:00:00",
            "updated_at" => "2022-06-12 00:00:00"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Berita'),
            $this->getTagIdByLanguageCode('id', 'Media Sosial'),
        ]);
        $post->translations()->attach(1);

        # 3
        $post = Post::create([
            "id" => 3,
            "post_title" => "فيسبوك يزيل إعلان ترامب فوق 'رمز الكراهية النازي'",
            "post_name" => "fysbok-yzyl-aal-n-tr-mb-fok-rmz-lkr-hy-ln-zy",
            "post_summary" => "<p>قالت شركة فيسبوك إنها أزالت الإعلانات الخاصة بحملة إعادة انتخاب الرئيس الأمريكي دونالد ترامب والتي ظهرت فيها رمز مستخدم في ألمانيا النازية.</p>",
            "post_content" => html_entity_decode("&lt;p&gt; &#x642;&#x627;&#x644;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x625;&#x646; &#x627;&#x644;&#x625;&#x639;&#x644;&#x627;&#x646; &#x627;&#x644;&#x645;&#x633;&#x64A;&#x621; &#x64A;&#x62D;&#x62A;&#x648;&#x64A; &#x639;&#x644;&#x649; &#x645;&#x62B;&#x644;&#x62B; &#x623;&#x62D;&#x645;&#x631; &#x645;&#x642;&#x644;&#x648;&#x628; &#x645;&#x634;&#x627;&#x628;&#x647; &#x644;&#x644;&#x645;&#x62B;&#x644;&#x62B; &#x627;&#x644;&#x630;&#x64A; &#x627;&#x633;&#x62A;&#x62E;&#x62F;&#x645;&#x647; &#x627;&#x644;&#x646;&#x627;&#x632;&#x64A;&#x648;&#x646; &#x644;&#x62A;&#x633;&#x645;&#x64A;&#x629; &#x627;&#x644;&#x645;&#x639;&#x627;&#x631;&#x636;&#x64A;&#x646; &#x645;&#x62B;&#x644; &#x627;&#x644;&#x634;&#x64A;&#x648;&#x639;&#x64A;&#x64A;&#x646;. &lt;/p&gt;
                &lt;p&gt; &#x642;&#x627;&#x644; &#x641;&#x631;&#x64A;&#x642; &#x62D;&#x645;&#x644;&#x629; &#x627;&#x644;&#x633;&#x64A;&#x62F; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x625;&#x646;&#x647;&#x645; &#x643;&#x627;&#x646;&#x648;&#x627; &#x64A;&#x633;&#x62A;&#x647;&#x62F;&#x641;&#x648;&#x646; &#x62C;&#x645;&#x627;&#x639;&#x629; &#x623;&#x646;&#x62A;&#x64A;&#x641;&#x627; &#x627;&#x644;&#x64A;&#x633;&#x627;&#x631;&#x64A;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x637;&#x631;&#x641;&#x629; &#x60C; &#x648;&#x627;&#x644;&#x62A;&#x64A; &#x642;&#x627;&#x644; &#x625;&#x646;&#x647;&#x627; &#x62A;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x627;&#x644;&#x631;&#x645;&#x632;. &lt;/p&gt;
                &lt;p&gt; &#x642;&#x627;&#x644; Facebook &#x625;&#x646; &#x627;&#x644;&#x625;&#x639;&#x644;&#x627;&#x646;&#x627;&#x62A; &#x62A;&#x646;&#x62A;&#x647;&#x643; &#x633;&#x64A;&#x627;&#x633;&#x62A;&#x647;&#x627; &#x636;&#x62F; &#x627;&#x644;&#x643;&#x631;&#x627;&#x647;&#x64A;&#x629; &#x627;&#x644;&#x645;&#x646;&#x638;&#x645;&#x629;. &lt;/p&gt;
                &lt;p&gt; &quot;&#x644;&#x627; &#x646;&#x633;&#x645;&#x62D; &#x628;&#x627;&#x644;&#x631;&#x645;&#x648;&#x632; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x645;&#x62B;&#x644; &#x627;&#x644;&#x645;&#x646;&#x638;&#x645;&#x627;&#x62A; &#x627;&#x644;&#x628;&#x63A;&#x64A;&#x636;&#x629; &#x623;&#x648; &#x627;&#x644;&#x623;&#x64A;&#x62F;&#x64A;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x628;&#x63A;&#x64A;&#x636;&#x629; &#x645;&#x627; &#x644;&#x645; &#x64A;&#x62A;&#x645; &#x627;&#x644;&#x62A;&#x639;&#x627;&#x645;&#x644; &#x645;&#x639;&#x647;&#x627; &#x628;&#x627;&#x644;&#x633;&#x64A;&#x627;&#x642; &#x623;&#x648; &#x627;&#x644;&#x625;&#x62F;&#x627;&#x646;&#x629;&quot; &#x60C; &#x647;&#x630;&#x627; &#x645;&#x627; &#x642;&#x627;&#x644;&#x647; &#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x633;&#x64A;&#x627;&#x633;&#x629; &#x627;&#x644;&#x623;&#x645;&#x646;&#x64A;&#x629; &#x644;&#x644;&#x634;&#x628;&#x643;&#x629; &#x627;&#x644;&#x627;&#x62C;&#x62A;&#x645;&#x627;&#x639;&#x64A;&#x629; &#x60C; &#x646;&#x627;&#x62B;&#x627;&#x646;&#x64A;&#x627;&#x644; &#x62C;&#x644;&#x627;&#x64A;&#x634;&#x631; &#x60C; &#x64A;&#x648;&#x645; &#x627;&#x644;&#x62E;&#x645;&#x64A;&#x633;. &lt;/p&gt;
                &lt;p&gt; &#x648;&#x623;&#x636;&#x627;&#x641;: &quot;&#x647;&#x630;&#x627; &#x645;&#x627; &#x631;&#x623;&#x64A;&#x646;&#x627;&#x647; &#x641;&#x64A; &#x647;&#x630;&#x647; &#x627;&#x644;&#x62D;&#x627;&#x644;&#x629; &#x645;&#x639; &#x647;&#x630;&#x627; &#x627;&#x644;&#x625;&#x639;&#x644;&#x627;&#x646; &#x60C; &#x648;&#x641;&#x64A; &#x623;&#x64A; &#x645;&#x643;&#x627;&#x646; &#x64A;&#x62A;&#x645; &#x641;&#x64A;&#x647; &#x627;&#x633;&#x62A;&#x62E;&#x62F;&#x627;&#x645; &#x647;&#x630;&#x627; &#x627;&#x644;&#x631;&#x645;&#x632; &#x633;&#x646;&#x62A;&#x62E;&#x630; &#x646;&#x641;&#x633; &#x627;&#x644;&#x625;&#x62C;&#x631;&#x627;&#x621;&#x627;&#x62A;.&quot; &lt;/p&gt;
                &lt;p&gt;&lt;/p&gt;
                &lt;figure class=&quot;image&quot;&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/180D5/production/_112971589_hi062017586.jpg&quot; style=&quot;width: 624px; height: 396px;&quot; alt=&quot;&#x644;&#x642;&#x637;&#x629; &#x634;&#x627;&#x634;&#x629; &#x62A;&#x648;&#x636;&#x62D; &#x627;&#x644;&#x631;&#x645;&#x632; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x641;&#x64A; &#x625;&#x639;&#x644;&#x627;&#x646; &#x62D;&#x645;&#x644;&#x629; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x648;&#x625;&#x632;&#x627;&#x644;&#x62A;&#x647; &#x645;&#x646; Facebook&quot; title=&quot;&#x644;&#x642;&#x637;&#x629; &#x634;&#x627;&#x634;&#x629; &#x62A;&#x648;&#x636;&#x62D; &#x627;&#x644;&#x631;&#x645;&#x632; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x641;&#x64A; &#x625;&#x639;&#x644;&#x627;&#x646; &#x62D;&#x645;&#x644;&#x629; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x648;&#x625;&#x632;&#x627;&#x644;&#x62A;&#x647; &#x645;&#x646; Facebook&quot;&gt;
                    &lt;figcaption class=&quot;captionClass&quot;&gt;&#x644;&#x642;&#x637;&#x629; &#x634;&#x627;&#x634;&#x629; &#x62A;&#x648;&#x636;&#x62D; &#x627;&#x644;&#x631;&#x645;&#x632; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x641;&#x64A; &#x625;&#x639;&#x644;&#x627;&#x646; &#x62D;&#x645;&#x644;&#x629; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x648;&#x625;&#x632;&#x627;&#x644;&#x62A;&#x647; &#x645;&#x646; Facebook&lt;/figcaption&gt;
                &lt;/figure&gt;&lt;br&gt;
                &lt;p&gt;&lt;/p&gt;
                &lt;p&gt; &#x643;&#x627;&#x646;&#x62A; &#x627;&#x644;&#x625;&#x639;&#x644;&#x627;&#x646;&#x627;&#x62A; &#x60C; &#x627;&#x644;&#x62A;&#x64A; &#x646;&#x64F;&#x634;&#x631;&#x62A; &#x639;&#x644;&#x649; &#x627;&#x644;&#x645;&#x648;&#x642;&#x639; &#x639;&#x644;&#x649; &#x635;&#x641;&#x62D;&#x627;&#x62A; &#x62A;&#x62E;&#x635; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x648;&#x646;&#x627;&#x626;&#x628;&#x647; &#x645;&#x627;&#x64A;&#x643; &#x628;&#x646;&#x633; &#x60C; &#x639;&#x644;&#x649; &#x627;&#x644;&#x625;&#x646;&#x62A;&#x631;&#x646;&#x62A; &#x644;&#x645;&#x62F;&#x629; 24 &#x633;&#x627;&#x639;&#x629; &#x62A;&#x642;&#x631;&#x64A;&#x628;&#x64B;&#x627; &#x648;&#x62A;&#x644;&#x642;&#x62A; &#x645;&#x626;&#x627;&#x62A; &#x627;&#x644;&#x622;&#x644;&#x627;&#x641; &#x645;&#x646; &#x627;&#x644;&#x645;&#x634;&#x627;&#x647;&#x62F;&#x627;&#x62A; &#x642;&#x628;&#x644; &#x625;&#x632;&#x627;&#x644;&#x62A;&#x647;&#x627;. &lt;/p&gt;
                &lt;p&gt; &#x642;&#x627;&#x644; &#x62A;&#x64A;&#x645; &#x645;&#x648;&#x631;&#x62A;&#x648; &#x60C; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x62B; &#x628;&#x627;&#x633;&#x645; &#x62D;&#x645;&#x644;&#x629; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x60C; &#x641;&#x64A; &#x628;&#x64A;&#x627;&#x646;: &quot;&#x627;&#x644;&#x645;&#x62B;&#x644;&#x62B; &#x627;&#x644;&#x623;&#x62D;&#x645;&#x631; &#x627;&#x644;&#x645;&#x642;&#x644;&#x648;&#x628; &#x647;&#x648; &#x631;&#x645;&#x632; &#x62A;&#x633;&#x62A;&#x62E;&#x62F;&#x645;&#x647; &#x623;&#x646;&#x62A;&#x64A;&#x641;&#x627; &#x60C; &#x644;&#x630;&#x644;&#x643; &#x62A;&#x645; &#x62A;&#x636;&#x645;&#x64A;&#x646;&#x647; &#x641;&#x64A; &#x625;&#x639;&#x644;&#x627;&#x646; &#x639;&#x646; &#x623;&#x646;&#x62A;&#x64A;&#x641;&#x627;&quot;. &lt;/p&gt;
                &lt;p&gt; &quot;&#x646;&#x644;&#x627;&#x62D;&#x638; &#x623;&#x646; Facebook &#x644;&#x627; &#x64A;&#x632;&#x627;&#x644; &#x64A;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x631;&#x645;&#x632;&#x64B;&#x627; &#x62A;&#x639;&#x628;&#x64A;&#x631;&#x64A;&#x64B;&#x627; &#x644;&#x645;&#x62B;&#x644;&#x62B; &#x623;&#x62D;&#x645;&#x631; &#x645;&#x642;&#x644;&#x648;&#x628; &#x60C; &#x648;&#x627;&#x644;&#x630;&#x64A; &#x64A;&#x628;&#x62F;&#x648; &#x645;&#x62A;&#x645;&#x627;&#x62B;&#x644;&#x64B;&#x627; &#x62A;&#x645;&#x627;&#x645;&#x64B;&#x627;&quot; &#x60C; &#x623;&#x636;&#x627;&#x641;. &lt;/p&gt;
                &lt;p&gt; &#x627;&#x62A;&#x647;&#x645; &#x627;&#x644;&#x633;&#x64A;&#x62F; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x645;&#x624;&#x62E;&#x631;&#x64B;&#x627; &#x645;&#x646;&#x638;&#x645;&#x629; &#x623;&#x646;&#x62A;&#x64A;&#x641;&#x627; &#x628;&#x628;&#x62F;&#x621; &#x623;&#x639;&#x645;&#x627;&#x644; &#x634;&#x63A;&#x628; &#x641;&#x64A; &#x627;&#x62D;&#x62A;&#x62C;&#x627;&#x62C;&#x627;&#x62A; &#x627;&#x644;&#x634;&#x648;&#x627;&#x631;&#x639; &#x641;&#x64A; &#x62C;&#x645;&#x64A;&#x639; &#x623;&#x646;&#x62D;&#x627;&#x621; &#x627;&#x644;&#x648;&#x644;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x639;&#x644;&#x649; &#x648;&#x641;&#x627;&#x629; &#x627;&#x644;&#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A; &#x645;&#x646; &#x623;&#x635;&#x644; &#x623;&#x641;&#x631;&#x64A;&#x642;&#x64A; &#x62C;&#x648;&#x631;&#x62C; &#x641;&#x644;&#x648;&#x64A;&#x62F; &#x641;&#x64A; &#x62D;&#x62C;&#x632; &#x627;&#x644;&#x634;&#x631;&#x637;&#x629;. &lt;/p&gt;
                &lt;p&gt; &#x642;&#x627;&#x644; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x634;&#x647;&#x631; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A; &#x625;&#x646;&#x647; &#x633;&#x64A;&#x639;&#x64A;&#x646; &#x627;&#x644;&#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x627;&#x644;&#x645;&#x646;&#x627;&#x647;&#x636;&#x629; &#x644;&#x644;&#x641;&#x627;&#x634;&#x64A;&#x629; &quot;&#x645;&#x646;&#x638;&#x645;&#x629; &#x625;&#x631;&#x647;&#x627;&#x628;&#x64A;&#x629; &#x645;&#x62D;&#x644;&#x64A;&#x629;&quot; &#x60C; &#x639;&#x644;&#x649; &#x627;&#x644;&#x631;&#x63A;&#x645; &#x645;&#x646; &#x623;&#x646; &#x627;&#x644;&#x62E;&#x628;&#x631;&#x627;&#x621; &#x627;&#x644;&#x642;&#x627;&#x646;&#x648;&#x646;&#x64A;&#x64A;&#x646; &#x634;&#x643;&#x643;&#x648;&#x627; &#x641;&#x64A; &#x633;&#x644;&#x637;&#x62A;&#x647; &#x644;&#x644;&#x642;&#x64A;&#x627;&#x645; &#x628;&#x630;&#x644;&#x643;. &lt;/p&gt;
                &lt;p&gt; &#x623;&#x646;&#x62A;&#x64A;&#x641;&#x627; &#x647;&#x64A; &#x62D;&#x631;&#x643;&#x629; &#x627;&#x62D;&#x62A;&#x62C;&#x627;&#x62C; &#x64A;&#x633;&#x627;&#x631;&#x64A;&#x629; &#x645;&#x62A;&#x637;&#x631;&#x641;&#x629; &#x62A;&#x639;&#x627;&#x631;&#x636; &#x627;&#x644;&#x646;&#x627;&#x632;&#x64A;&#x64A;&#x646; &#x627;&#x644;&#x62C;&#x62F;&#x62F; &#x648;&#x627;&#x644;&#x641;&#x627;&#x634;&#x64A;&#x629; &#x648;&#x623;&#x646;&#x635;&#x627;&#x631; &#x62A;&#x641;&#x648;&#x642; &#x627;&#x644;&#x628;&#x64A;&#x636; &#x648;&#x627;&#x644;&#x639;&#x646;&#x635;&#x631;&#x64A;&#x629;. &#x62A;&#x639;&#x62A;&#x628;&#x631; &#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x645;&#x646;&#x638;&#x645;&#x629; &#x628;&#x634;&#x643;&#x644; &#x641;&#x636;&#x641;&#x627;&#x636; &#x645;&#x646; &#x627;&#x644;&#x646;&#x634;&#x637;&#x627;&#x621; &#x628;&#x62F;&#x648;&#x646; &#x642;&#x627;&#x62F;&#x629;. &lt;/p&gt;
                &lt;p&gt; &#x634;&#x62C;&#x628; &#x645;&#x639;&#x638;&#x645; &#x627;&#x644;&#x623;&#x639;&#x636;&#x627;&#x621; &#x645;&#x627; &#x64A;&#x631;&#x648;&#x646; &#x623;&#x646;&#x647; &#x633;&#x64A;&#x627;&#x633;&#x627;&#x62A; &#x627;&#x644;&#x633;&#x64A;&#x62F; &#x62A;&#x631;&#x627;&#x645;&#x628; &#x627;&#x644;&#x642;&#x648;&#x645;&#x64A;&#x629; &#x648;&#x627;&#x644;&#x645;&#x646;&#x627;&#x647;&#x636;&#x629; &#x644;&#x644;&#x647;&#x62C;&#x631;&#x629; &#x648;&#x627;&#x644;&#x645;&#x633;&#x644;&#x645;&#x64A;&#x646;. &lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image1.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:00",
            "updated_at" => "2022-06-12 00:00:00"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'أخبار'),
            $this->getTagIdByLanguageCode('ar', 'وسائل التواصل الاجتماعي'),
        ]);
        $post->translations()->attach(1);

        # Post Translation Relations 4,5, 6

        Translation::create([
            'id' => 2,
            'value' => json_encode([
                'en' => 4,
                'id' => 5,
                'ar' => 6,
            ])
        ]);

        # 4

        $post = Post::create([
            "id" => 4,
            "post_title" => "Tech Takeovers Feed Into China Cold War Fears",
            "post_name" => "tech-takeovers-feed-into-china-cold-war-fears",
            "post_summary" => html_entity_decode("&lt;p&gt;The UK government is planning new measures to restrict foreign takeovers on national security grounds.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;h3&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;But security experts caution the UK has been late to the issue.&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;It comes amid growing concern about the risk of China buying high-tech companies, especially in the economic turmoil resulting from the coronavirus pandemic.&lt;/p&gt;&lt;p&gt;At the height of the crisis, a boardroom manoeuvre nearly went unnoticed.&lt;/p&gt;&lt;p&gt;And it flared up into a row that goes to the heart of on an increasingly contentious issue - has the UK failed to stop high-tech industries passing into Chinese hands?&lt;/p&gt;&lt;h3&gt;Taking control&lt;/h3&gt;&lt;p&gt;In 2017, Imagination Technologies, a Hertfordshire-based company at the cutting edge of computer-chip design, whose tech is used on iPhones, was bought by Canyon Bridge Partners, a private equity firm based in the Cayman Islands.&lt;/p&gt;&lt;p&gt;But 99% of the funds for the purchase came from China Reform, backed by the state in Beijing.&lt;/p&gt;&lt;p&gt;And this spring, Canyon Bridge Partners tried to install new directors linked to China Reform.&lt;/p&gt;&lt;p&gt;One of those to raise the alarm, Sir Hossein Yassaie, a former chief executive of the company, feared assurances it would not be moved to China were at risk of being broken.&lt;/p&gt;&lt;p&gt;&quot;It looked like there was an attempt to basically change the ownership and control of the company,&quot; he told a documentary made for BBC Radio 4 .&lt;/p&gt;&lt;p&gt;&quot;My stance on Imagination is fundamentally about making sure a very important ecosystem... is maintained as an independent, properly governed supplier.&quot;&lt;/p&gt;&lt;p&gt;The issue was taken up by Tom Tugendhat MP, who chairs the Foreign Affairs Select Committee, which held a hearing in May.&lt;/p&gt;&lt;p&gt;Canyon Bridge denied China had any untoward influence over the purchase or its activities, arguing the decisions were purely commercial.&lt;/p&gt;&lt;p&gt;And some of the changes were halted.&lt;/p&gt;&lt;p&gt;But those involved believe it was an indication of a wider problem.&lt;/p&gt;&lt;p&gt;&quot;This is just part of an incremental process where technology is being moved out of the UK, and out of the West, and towards China,&quot; Mr Tugendhat says.&lt;/p&gt;&lt;h3&gt;&apos;World changed&apos;&lt;/h3&gt;&lt;p&gt;Has the UK been too ready to allow some of its &quot;crown jewel&quot; technology companies to be sold into foreign hands?&lt;/p&gt;&lt;p&gt;&quot;The simple answer unfortunately is, &apos;Yes.&apos;&quot; Sir Hossein says.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/170BC/production/_112969349_uk.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;And Elisabeth Braw, of the Royal United Services Institute think tank, believes many other cases in which cutting edge technology have shifted to China have gone unreported.&lt;/p&gt;&lt;p&gt;&quot;The UK has been late to understand this,&quot; she says.&lt;/p&gt;&lt;p&gt;&quot;It sort of goes against this idea that globalisation is a force for good, if you start saying, &apos;Well, we need to scrutinise foreign investors.&apos;&lt;/p&gt;&lt;p&gt;But actually the world has changed and China is exploiting globalisation for its own gains.&quot;&lt;/p&gt;&lt;p&gt;Theresa May&apos;s government announced plans to look at the issue in 2018.&lt;/p&gt;&lt;p&gt;A bill promising new powers to assess mergers and takeovers was promised in the Queen&apos;s Speech last December.&lt;/p&gt;&lt;p&gt;And in May, Prime Minister Boris Johnson said parliamentarians were &quot;right to be concerned&quot; about the buying up of UK technology by countries that had &quot;ulterior motives&quot;, and promised new measures in the coming weeks.&lt;/p&gt;&lt;p&gt;Others have already acted.&lt;/p&gt;&lt;p&gt;The purchase of a robotics manufacturer by a Chinese company led Germany in 2017 to place new restrictions on takeovers.&lt;/p&gt;&lt;p&gt;US intelligence officials have also increasingly focused on looking for a hidden hand from the Chinese state in business deals.&lt;/p&gt;&lt;p&gt;&quot;You might see an acquisition and on its face it makes all the sense in the world,&quot; US National Counterintelligence and Security Center director Bill Evanina told BBC News.&lt;/p&gt;&lt;p&gt;&quot;But there needs to be intelligence services peeling back that onion to identify who the backdoor owners are and who the financiers of that acquisition are.&quot;&lt;/p&gt;&lt;p&gt;Mr Evanina says that, after having been &quot;a little bit slow, in the last two to three years&quot;, the US government has become more active in warning the private sector.&lt;/p&gt;&lt;p&gt;In the UK, MI5 plays a similar role and informs decisions about whether technology takeovers are in the national interest - but few have been stopped.&lt;/p&gt;&lt;h3&gt;Strategic advantage&lt;/h3&gt;&lt;p&gt;One of the more surprising rows came after the gay dating site Grindr was purchased by a Chinese company.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/6334/production/_112969352_china.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The US raised national security concerns because of the fear the personal data could be used to compromise or influence individuals.&lt;/p&gt;&lt;p&gt;And the company was eventually sold.&lt;/p&gt;&lt;p&gt;&quot;The regulator realised that having that information at the disposal of the Chinese government ultimately was a very bad idea for US national security,&quot; Ms Braw says.&lt;/p&gt;&lt;p&gt;&quot;We need to change our understanding of which companies are vital to national security and treat them just like we treated defence companies in the Cold War&quot;.&lt;/p&gt;&lt;p&gt;One concern for Mr Evanina is the extent to which China can use a combination of acquisitions, its own technology companies and cyber-espionage to build up large databases of personal information.&lt;/p&gt;&lt;p&gt;&quot;The ability to have information on every human in the world that that human doesn&apos;t even have on themselves provides them with a strategic advantage, not only from an espionage perspective but a compromise perspective [and] understanding plans and intentions of companies,&quot; he says.&lt;/p&gt;&lt;p&gt;&lt;i&gt;The New Tech Cold War will be broadcast on BBC Radio 4 at 11:00 on Friday and again on Tuesday at 16:00&lt;/i&gt;&lt;/p&gt;"),
            "meta_description" => "The UK government is planning new measures to restrict foreign takeovers on national security grounds.",
            "meta_keyword" => "Tecnhology, China, United Kindom",
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image4.jpg",
            "post_hits" => 4,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:01",
            "updated_at" => "2022-06-12 00:00:01"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Facebook'),
            $this->getTagIdByLanguageCode('en', 'Donald Trump')
        ]);
        $post->translations()->attach(2);

        # 5

        $post = Post::create([
            "id" => 5,
            "post_title" => "Pengambilalihan Teknologi Memasukkan Ke dalam Ketakutan Perang Dingin China",
            "post_name" => "pengambilalihan-teknologi-memasukkan-ke-dalam-ketakutan-perang-dingin-china",
            "post_summary" => html_entity_decode("&lt;p&gt;Pemerintah Inggris sedang merencanakan langkah-langkah baru untuk membatasi pengambilalihan asing dengan alasan keamanan nasional.&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Namun pakar keamanan memperingatkan Inggris terlambat menangani masalah ini.&lt;/p&gt;&lt;p&gt;Itu terjadi di tengah meningkatnya kekhawatiran tentang risiko China membeli perusahaan teknologi tinggi, terutama dalam gejolak ekonomi akibat pandemi virus corona.&lt;/p&gt;&lt;p&gt;Pada puncak krisis, manuver ruang rapat hampir tidak diperhatikan.&lt;/p&gt;&lt;p&gt;Dan itu berkobar menjadi pertikaian yang mengarah ke inti masalah yang semakin diperdebatkan - apakah Inggris telah gagal menghentikan industri teknologi tinggi yang beralih ke tangan China?&lt;/p&gt;&lt;h3&gt;Mengambil alih&lt;/h3&gt;&lt;p&gt;Pada tahun 2017, Imagination Technologies, sebuah perusahaan yang berbasis di Hertfordshire di ujung tombak desain chip komputer, yang teknologinya digunakan pada iPhone, dibeli oleh Canyon Bridge Partners, sebuah perusahaan ekuitas swasta yang berbasis di Kepulauan Cayman.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Tapi 99% dana untuk pembelian itu berasal dari China Reform, yang didukung oleh negara di Beijing.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dan musim semi ini, Canyon Bridge Partners mencoba memasang direktur baru yang terkait dengan Reformasi China.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Salah satu dari mereka yang memperingatkan, Sir Hossein Yassaie, mantan kepala eksekutif perusahaan, khawatir jaminan bahwa perusahaan itu tidak akan dipindahkan ke China berisiko rusak.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Sepertinya ada upaya untuk mengubah kepemilikan dan kendali perusahaan pada dasarnya,&quot; katanya kepada sebuah film dokumenter yang dibuat untuk BBC Radio 4 .&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Pendirian saya tentang Imajinasi pada dasarnya adalah memastikan ekosistem yang sangat penting ... dipertahankan sebagai pemasok independen yang diatur dengan benar.&quot;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Masalah ini diangkat oleh Tom Tugendhat MP, yang memimpin Komite Pemilihan Luar Negeri, yang mengadakan dengar pendapat pada bulan Mei.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Canyon Bridge membantah China memiliki pengaruh yang tidak diinginkan atas pembelian atau kegiatannya, dengan alasan keputusan itu murni komersial.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dan beberapa perubahan dihentikan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Tetapi mereka yang terlibat percaya itu adalah indikasi masalah yang lebih luas.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Ini hanya bagian dari proses tambahan di mana teknologi dipindahkan dari Inggris, dan keluar dari Barat, dan menuju China,&quot; kata Tugendhat.&lt;/span&gt;&lt;/p&gt;&lt;h3&gt;'Dunia berubah'&lt;/h3&gt;&lt;p&gt;Apakah Inggris terlalu siap untuk mengizinkan beberapa perusahaan teknologi &quot;permata mahkota&quot; dijual ke tangan asing?&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Sayangnya, jawaban sederhananya adalah, 'Ya.'&quot; kata Sir Hossein.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/170BC/production/_112969349_uk.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Dan Elisabeth Braw, dari think tank Royal United Services Institute, percaya banyak kasus lain di mana teknologi canggih telah bergeser ke China tidak dilaporkan.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Inggris terlambat memahami hal ini,&quot; katanya.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Ini agak bertentangan dengan gagasan bahwa globalisasi adalah kekuatan untuk kebaikan, jika Anda mulai berkata, 'Ya, kita perlu meneliti investor asing.'&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Tapi sebenarnya dunia telah berubah dan China mengeksploitasi globalisasi untuk keuntungannya sendiri.&quot;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pemerintah Theresa May mengumumkan rencana untuk melihat masalah ini pada tahun 2018.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Sebuah RUU yang menjanjikan kekuatan baru untuk menilai merger dan pengambilalihan dijanjikan dalam Pidato Ratu Desember lalu.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dan pada bulan Mei, Perdana Menteri Boris Johnson mengatakan anggota parlemen &quot;benar untuk khawatir&quot; tentang pembelian teknologi Inggris oleh negara-negara yang memiliki &quot;motif tersembunyi&quot;, dan menjanjikan langkah-langkah baru dalam beberapa minggu mendatang.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Yang lain sudah bertindak.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pembelian produsen robotika oleh perusahaan China membuat Jerman pada 2017 memberlakukan pembatasan baru pada pengambilalihan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pejabat intelijen AS juga semakin fokus mencari tangan tersembunyi dari negara China dalam kesepakatan bisnis.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Anda mungkin melihat akuisisi dan secara langsung itu masuk akal di dunia,&quot; kata direktur Pusat Kontra Intelijen dan Keamanan Nasional AS Bill Evanina kepada BBC News.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Tetapi perlu ada badan intelijen yang mengupas bawang itu untuk mengidentifikasi siapa pemilik pintu belakang dan siapa pemodal akuisisi itu.&quot;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Mr Evanina mengatakan bahwa, setelah &quot;sedikit lambat, dalam dua sampai tiga tahun terakhir&quot;, pemerintah AS menjadi lebih aktif dalam memperingatkan sektor swasta.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Di Inggris, MI5 memainkan peran serupa dan menginformasikan keputusan tentang apakah pengambilalihan teknologi merupakan kepentingan nasional - tetapi hanya sedikit yang dihentikan.&lt;/span&gt;&lt;/p&gt;&lt;h3&gt;Keunggulan strategis&lt;/h3&gt;&lt;p&gt;Salah satu baris yang lebih mengejutkan datang setelah situs kencan gay Grindr dibeli oleh sebuah perusahaan Cina.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/6334/production/_112969352_china.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;AS mengangkat masalah keamanan nasional karena takut data pribadi dapat digunakan untuk berkompromi atau mempengaruhi individu.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dan perusahaan itu akhirnya dijual.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Regulator menyadari bahwa memiliki informasi itu untuk pemerintah China pada akhirnya adalah ide yang sangat buruk untuk keamanan nasional AS,&quot; kata Braw.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Kita perlu mengubah pemahaman kita tentang perusahaan mana yang penting bagi keamanan nasional dan memperlakukan mereka seperti kita memperlakukan perusahaan pertahanan di Perang Dingin&quot;.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Satu kekhawatiran bagi Evanina adalah sejauh mana China dapat menggunakan kombinasi akuisisi, perusahaan teknologinya sendiri, dan spionase siber untuk membangun basis data besar informasi pribadi.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&quot;Kemampuan untuk memiliki informasi tentang setiap manusia di dunia yang bahkan tidak dimiliki manusia itu sendiri memberi mereka keuntungan strategis, tidak hanya dari perspektif spionase tetapi juga perspektif kompromi [dan] memahami rencana dan niat perusahaan,&quot; dia berkata.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&lt;i&gt;Perang Dingin Teknologi Baru akan disiarkan di Radio BBC 4 pada pukul 11:00 pada hari Jumat dan lagi pada hari Selasa pukul 16:00&lt;/i&gt;&lt;/span&gt;&lt;/p&gt;"),
            "meta_description" => "Pemerintah Inggris sedang merencanakan langkah-langkah baru untuk membatasi pengambilalihan asing dengan alasan keamanan nasional.",
            "meta_keyword" => "Teknologi, China, United Kindom",
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image4.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:01",
            "updated_at" => "2022-06-12 00:00:01"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Teknologi'),
            $this->getTagIdByLanguageCode('id', 'Facebook'),
            $this->getTagIdByLanguageCode('id', 'Donald Trump')
        ]);
        $post->translations()->attach(2);

        # 6

        $post = Post::create([
            "id" => 6,
            "post_title" => "الاستحواذ التكنولوجي يغذي مخاوف الحرب الباردة في الصين",
            "post_name" => "l-stho-th-ltknology-yghthy-mkh-of-lhrb-lb-rd-fy-lsyn",
            "post_summary" => "<p>تخطط حكومة المملكة المتحدة لإجراءات جديدة لتقييد عمليات الاستحواذ الأجنبية لأسباب تتعلق بالأمن القومي.</p>",
            "post_content" =>  html_entity_decode("&lt;h3&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&#x644;&#x643;&#x646; &#x62E;&#x628;&#x631;&#x627;&#x621; &#x623;&#x645;&#x646;&#x64A;&#x64A;&#x646; &#x64A;&#x62D;&#x630;&#x631;&#x648;&#x646; &#x645;&#x646; &#x623;&#x646; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x62A;&#x623;&#x62E;&#x631;&#x62A; &#x641;&#x64A; &#x645;&#x639;&#x627;&#x644;&#x62C;&#x629; &#x647;&#x630;&#x647; &#x627;&#x644;&#x642;&#x636;&#x64A;&#x629;.&lt;/span&gt;&lt;/h3&gt;
                &lt;p&gt;&#x64A;&#x623;&#x62A;&#x64A; &#x630;&#x644;&#x643; &#x648;&#x633;&#x637; &#x642;&#x644;&#x642; &#x645;&#x62A;&#x632;&#x627;&#x64A;&#x62F; &#x628;&#x634;&#x623;&#x646; &#x645;&#x62E;&#x627;&#x637;&#x631; &#x634;&#x631;&#x627;&#x621; &#x627;&#x644;&#x635;&#x64A;&#x646; &#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x641;&#x627;&#x626;&#x642;&#x629; &#x60C; &#x62E;&#x627;&#x635;&#x629; &#x641;&#x64A; &#x638;&#x644; &#x627;&#x644;&#x627;&#x636;&#x637;&#x631;&#x627;&#x628;&#x627;&#x62A; &#x627;&#x644;&#x627;&#x642;&#x62A;&#x635;&#x627;&#x62F;&#x64A;&#x629; &#x627;&#x644;&#x646;&#x627;&#x62A;&#x62C;&#x629; &#x639;&#x646; &#x62C;&#x627;&#x626;&#x62D;&#x629; &#x641;&#x64A;&#x631;&#x648;&#x633; &#x643;&#x648;&#x631;&#x648;&#x646;&#x627;.&lt;/p&gt;
                &lt;p&gt;&#x641;&#x64A; &#x630;&#x631;&#x648;&#x629; &#x627;&#x644;&#x623;&#x632;&#x645;&#x629; &#x60C; &#x643;&#x627;&#x646;&#x62A; &#x645;&#x646;&#x627;&#x648;&#x631;&#x629; &#x645;&#x62C;&#x644;&#x633; &#x627;&#x644;&#x625;&#x62F;&#x627;&#x631;&#x629; &#x643;&#x627;&#x62F;&#x62A; &#x62A;&#x645;&#x631; &#x645;&#x631;&#x648;&#x631; &#x627;&#x644;&#x643;&#x631;&#x627;&#x645; &#x62F;&#x648;&#x646; &#x623;&#x646; &#x64A;&#x644;&#x627;&#x62D;&#x638;&#x647;&#x627; &#x623;&#x62D;&#x62F;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x627;&#x646;&#x62F;&#x644;&#x639;&#x62A; &#x641;&#x64A; &#x635;&#x631;&#x627;&#x639; &#x64A;&#x630;&#x647;&#x628; &#x625;&#x644;&#x649; &#x642;&#x644;&#x628; &#x642;&#x636;&#x64A;&#x629; &#x645;&#x62B;&#x64A;&#x631;&#x629; &#x644;&#x644;&#x62C;&#x62F;&#x644; &#x639;&#x644;&#x649; &#x646;&#x62D;&#x648; &#x645;&#x62A;&#x632;&#x627;&#x64A;&#x62F; - &#x647;&#x644; &#x641;&#x634;&#x644;&#x62A; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x641;&#x64A; &#x648;&#x642;&#x641; &#x635;&#x646;&#x627;&#x639;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x641;&#x627;&#x626;&#x642;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x646;&#x62A;&#x642;&#x644; &#x625;&#x644;&#x649; &#x623;&#x64A;&#x62F;&#x64A; &#x627;&#x644;&#x635;&#x64A;&#x646;&#x64A;&#x64A;&#x646;&#x61F;&lt;/p&gt;
                &lt;h3&gt;&#x627;&#x644;&#x633;&#x64A;&#x637;&#x631;&#x629;&lt;/h3&gt;
                &lt;p&gt;&#x641;&#x64A; &#x639;&#x627;&#x645; 2017 &#x60C; &#x627;&#x634;&#x62A;&#x631;&#x62A; &#x634;&#x631;&#x643;&#x629; &#x643;&#x627;&#x646;&#x64A;&#x648;&#x646; &#x628;&#x631;&#x64A;&#x62F;&#x62C; &#x628;&#x627;&#x631;&#x62A;&#x646;&#x631;&#x632; Canyon Bridge Partners &#x60C; &#x648;&#x647;&#x64A; &#x634;&#x631;&#x643;&#x629; &#x623;&#x633;&#x647;&#x645; &#x62E;&#x627;&#x635;&#x629; &#x645;&#x642;&#x631;&#x647;&#x627; &#x62C;&#x632;&#x631; &#x643;&#x627;&#x64A;&#x645;&#x627;&#x646; &#x60C; &#x634;&#x631;&#x643;&#x629; Imagination Technologies &#x60C; &#x648;&#x647;&#x64A; &#x634;&#x631;&#x643;&#x629; &#x645;&#x642;&#x631;&#x647;&#x627; &#x647;&#x64A;&#x631;&#x62A;&#x641;&#x648;&#x631;&#x62F;&#x634;&#x627;&#x64A;&#x631; &#x62A;&#x62A;&#x645;&#x62A;&#x639; &#x628;&#x623;&#x62D;&#x62F;&#x62B; &#x62A;&#x635;&#x645;&#x64A;&#x645; &#x644;&#x634;&#x631;&#x627;&#x626;&#x62D; &#x627;&#x644;&#x643;&#x645;&#x628;&#x64A;&#x648;&#x62A;&#x631; &#x60C; &#x648;&#x62A;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x62A;&#x642;&#x646;&#x64A;&#x62A;&#x647;&#x627; &#x641;&#x64A; &#x623;&#x62C;&#x647;&#x632;&#x629; iPhone.&lt;/p&gt;
                &lt;p&gt;&#x644;&#x643;&#x646; 99&#x66A; &#x645;&#x646; &#x627;&#x644;&#x623;&#x645;&#x648;&#x627;&#x644; &#x627;&#x644;&#x645;&#x62E;&#x635;&#x635;&#x629; &#x644;&#x644;&#x634;&#x631;&#x627;&#x621; &#x62C;&#x627;&#x621;&#x62A; &#x645;&#x646; China Reform &#x60C; &#x628;&#x62F;&#x639;&#x645; &#x645;&#x646; &#x627;&#x644;&#x62F;&#x648;&#x644;&#x629; &#x641;&#x64A; &#x628;&#x643;&#x64A;&#x646;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x641;&#x64A; &#x631;&#x628;&#x64A;&#x639; &#x647;&#x630;&#x627; &#x627;&#x644;&#x639;&#x627;&#x645; &#x60C; &#x62D;&#x627;&#x648;&#x644; &#x643;&#x627;&#x646;&#x64A;&#x648;&#x646; &#x628;&#x631;&#x64A;&#x62F;&#x62C; &#x628;&#x627;&#x631;&#x62A;&#x646;&#x631;&#x632; &#x62A;&#x639;&#x64A;&#x64A;&#x646; &#x645;&#x62F;&#x64A;&#x631;&#x64A;&#x646; &#x62C;&#x62F;&#x62F; &#x645;&#x631;&#x62A;&#x628;&#x637;&#x64A;&#x646; &#x628;&#x625;&#x635;&#x644;&#x627;&#x62D; &#x627;&#x644;&#x635;&#x64A;&#x646;.&lt;/p&gt;
                &lt;p&gt;&#x623;&#x62D;&#x62F; &#x623;&#x648;&#x644;&#x626;&#x643; &#x627;&#x644;&#x630;&#x64A;&#x646; &#x62F;&#x642;&#x648;&#x627; &#x646;&#x627;&#x642;&#x648;&#x633; &#x627;&#x644;&#x62E;&#x637;&#x631; &#x60C; &#x648;&#x647;&#x648; &#x627;&#x644;&#x633;&#x64A;&#x631; &#x62D;&#x633;&#x64A;&#x646; &#x64A;&#x627;&#x633;&#x627;&#x64A; &#x60C; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x62A;&#x646;&#x641;&#x64A;&#x630;&#x64A; &#x627;&#x644;&#x633;&#x627;&#x628;&#x642; &#x644;&#x644;&#x634;&#x631;&#x643;&#x629; &#x60C; &#x64A;&#x62E;&#x634;&#x649; &#x623;&#x646; &#x62A;&#x643;&#x648;&#x646; &#x627;&#x644;&#x62A;&#x623;&#x643;&#x64A;&#x62F;&#x627;&#x62A; &#x628;&#x623;&#x646;&#x647; &#x644;&#x646; &#x64A;&#x62A;&#x645; &#x646;&#x642;&#x644;&#x647;&#x627; &#x625;&#x644;&#x649; &#x627;&#x644;&#x635;&#x64A;&#x646; &#x645;&#x639;&#x631;&#x636;&#x629; &#x644;&#x62E;&#x637;&#x631; &#x627;&#x644;&#x627;&#x646;&#x647;&#x64A;&#x627;&#x631;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x642;&#x627;&#x644; &#x641;&#x64A; &#x641;&#x64A;&#x644;&#x645; &#x648;&#x62B;&#x627;&#x626;&#x642;&#x64A; &#x623;&#x639;&#x62F; &#x644;&#x631;&#x627;&#x62F;&#x64A;&#x648; &#x628;&#x64A; &#x628;&#x64A; &#x633;&#x64A; 4 &quot;&#x64A;&#x628;&#x62F;&#x648; &#x623;&#x646; &#x647;&#x646;&#x627;&#x643; &#x645;&#x62D;&#x627;&#x648;&#x644;&#x629; &#x644;&#x62A;&#x63A;&#x64A;&#x64A;&#x631; &#x645;&#x644;&#x643;&#x64A;&#x629; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x648;&#x627;&#x644;&#x633;&#x64A;&#x637;&#x631;&#x629; &#x639;&#x644;&#x64A;&#x647;&#x627; &#x628;&#x634;&#x643;&#x644; &#x623;&#x633;&#x627;&#x633;&#x64A;&quot;.&lt;/p&gt;
                &lt;p&gt;&quot;&#x645;&#x648;&#x642;&#x641;&#x64A; &#x645;&#x646; &#x627;&#x644;&#x62E;&#x64A;&#x627;&#x644; &#x64A;&#x62A;&#x639;&#x644;&#x642; &#x628;&#x634;&#x643;&#x644; &#x623;&#x633;&#x627;&#x633;&#x64A; &#x628;&#x627;&#x644;&#x62A;&#x623;&#x643;&#x62F; &#x645;&#x646; &#x627;&#x644;&#x62D;&#x641;&#x627;&#x638; &#x639;&#x644;&#x649; &#x646;&#x638;&#x627;&#x645; &#x628;&#x64A;&#x626;&#x64A; &#x645;&#x647;&#x645; &#x644;&#x644;&#x63A;&#x627;&#x64A;&#x629; ... &#x643;&#x645;&#x648;&#x631;&#x62F; &#x645;&#x633;&#x62A;&#x642;&#x644; &#x648;&#x645;&#x62D;&#x643;&#x645; &#x628;&#x634;&#x643;&#x644; &#x635;&#x62D;&#x64A;&#x62D;.&quot;&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x645; &#x62A;&#x646;&#x627;&#x648;&#x644; &#x647;&#x630;&#x647; &#x627;&#x644;&#x642;&#x636;&#x64A;&#x629; &#x645;&#x646; &#x642;&#x628;&#x644; &#x627;&#x644;&#x646;&#x627;&#x626;&#x628; &#x62A;&#x648;&#x645; &#x62A;&#x648;&#x62C;&#x646;&#x62F;&#x647;&#x627;&#x62A; &#x60C; &#x627;&#x644;&#x630;&#x64A; &#x64A;&#x631;&#x623;&#x633; &#x644;&#x62C;&#x646;&#x629; &#x627;&#x644;&#x634;&#x624;&#x648;&#x646; &#x627;&#x644;&#x62E;&#x627;&#x631;&#x62C;&#x64A;&#x629; &#x60C; &#x627;&#x644;&#x62A;&#x64A; &#x639;&#x642;&#x62F;&#x62A; &#x62C;&#x644;&#x633;&#x629; &#x627;&#x633;&#x62A;&#x645;&#x627;&#x639; &#x641;&#x64A; &#x645;&#x627;&#x64A;&#x648;.&lt;/p&gt;
                &lt;p&gt;&#x646;&#x641;&#x649; &#x643;&#x627;&#x646;&#x64A;&#x648;&#x646; &#x628;&#x631;&#x64A;&#x62F;&#x62C; &#x623;&#x646; &#x64A;&#x643;&#x648;&#x646; &#x644;&#x644;&#x635;&#x64A;&#x646; &#x623;&#x64A; &#x62A;&#x623;&#x62B;&#x64A;&#x631; &#x63A;&#x64A;&#x631; &#x645;&#x631;&#x63A;&#x648;&#x628; &#x641;&#x64A;&#x647; &#x639;&#x644;&#x649; &#x627;&#x644;&#x634;&#x631;&#x627;&#x621; &#x623;&#x648; &#x623;&#x646;&#x634;&#x637;&#x62A;&#x647; &#x60C; &#x628;&#x62D;&#x62C;&#x629; &#x623;&#x646; &#x627;&#x644;&#x642;&#x631;&#x627;&#x631;&#x627;&#x62A; &#x643;&#x627;&#x646;&#x62A; &#x62A;&#x62C;&#x627;&#x631;&#x64A;&#x629; &#x628;&#x62D;&#x62A;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x62A;&#x648;&#x642;&#x641;&#x62A; &#x628;&#x639;&#x636; &#x627;&#x644;&#x62A;&#x63A;&#x64A;&#x64A;&#x631;&#x627;&#x62A;.&lt;/p&gt;
                &lt;p&gt;&#x644;&#x643;&#x646; &#x627;&#x644;&#x645;&#x62A;&#x648;&#x631;&#x637;&#x64A;&#x646; &#x64A;&#x639;&#x62A;&#x642;&#x62F;&#x648;&#x646; &#x623;&#x646;&#x647; &#x643;&#x627;&#x646; &#x645;&#x624;&#x634;&#x631;&#x627; &#x639;&#x644;&#x649; &#x645;&#x634;&#x643;&#x644;&#x629; &#x623;&#x648;&#x633;&#x639;.&lt;/p&gt;
                &lt;p&gt;&#x64A;&#x642;&#x648;&#x644; &#x62A;&#x648;&#x62C;&#x646;&#x62F;&#x647;&#x627;&#x62A;: &quot;&#x647;&#x630;&#x627; &#x645;&#x62C;&#x631;&#x62F; &#x62C;&#x632;&#x621; &#x645;&#x646; &#x639;&#x645;&#x644;&#x64A;&#x629; &#x62A;&#x62F;&#x631;&#x64A;&#x62C;&#x64A;&#x629; &#x64A;&#x62A;&#x645; &#x641;&#x64A;&#x647;&#x627; &#x646;&#x642;&#x644; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x62E;&#x627;&#x631;&#x62C; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x60C; &#x648;&#x645;&#x646; &#x627;&#x644;&#x63A;&#x631;&#x628; &#x60C; &#x648;&#x646;&#x62D;&#x648; &#x627;&#x644;&#x635;&#x64A;&#x646;&quot;.&lt;/p&gt;
                &lt;h3&gt;&quot;&#x627;&#x644;&#x639;&#x627;&#x644;&#x645; &#x62A;&#x63A;&#x64A;&#x631;&quot;&lt;/h3&gt;
                &lt;p&gt;&#x647;&#x644; &#x643;&#x627;&#x646;&#x62A; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x645;&#x633;&#x62A;&#x639;&#x62F;&#x629; &#x644;&#x644;&#x63A;&#x627;&#x64A;&#x629; &#x644;&#x644;&#x633;&#x645;&#x627;&#x62D; &#x628;&#x628;&#x64A;&#x639; &#x628;&#x639;&#x636; &#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &quot;&#x62C;&#x648;&#x647;&#x631;&#x629; &#x627;&#x644;&#x62A;&#x627;&#x62C;&quot; &#x625;&#x644;&#x649; &#x623;&#x64A;&#x62F;&#x64D; &#x623;&#x62C;&#x646;&#x628;&#x64A;&#x629;&#x61F;&lt;/p&gt;
                &lt;p&gt;&quot;&#x627;&#x644;&#x62C;&#x648;&#x627;&#x628; &#x627;&#x644;&#x628;&#x633;&#x64A;&#x637; &#x644;&#x644;&#x623;&#x633;&#x641; &#x647;&#x648; &#x646;&#x639;&#x645;&quot;. &#x64A;&#x642;&#x648;&#x644; &#x627;&#x644;&#x633;&#x64A;&#x631; &#x62D;&#x633;&#x64A;&#x646;.&lt;/p&gt;
                &lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/170BC/production/_112969349_uk.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;
                &lt;p&gt;&#x648;&#x62A;&#x639;&#x62A;&#x642;&#x62F; &#x625;&#x644;&#x64A;&#x632;&#x627;&#x628;&#x64A;&#x62B; &#x628;&#x631;&#x627;&#x648; &#x60C; &#x645;&#x646; &#x645;&#x639;&#x647;&#x62F; &#x631;&#x648;&#x64A;&#x627;&#x644; &#x64A;&#x648;&#x646;&#x627;&#x64A;&#x62A;&#x62F; &#x644;&#x644;&#x62E;&#x62F;&#x645;&#x627;&#x62A; &#x627;&#x644;&#x628;&#x62D;&#x62B;&#x64A;&#x629; &#x60C; &#x623;&#x646; &#x627;&#x644;&#x639;&#x62F;&#x64A;&#x62F; &#x645;&#x646; &#x627;&#x644;&#x62D;&#x627;&#x644;&#x627;&#x62A; &#x627;&#x644;&#x623;&#x62E;&#x631;&#x649; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x62D;&#x648;&#x644;&#x62A; &#x641;&#x64A;&#x647;&#x627; &#x623;&#x62D;&#x62F;&#x62B; &#x627;&#x644;&#x62A;&#x642;&#x646;&#x64A;&#x627;&#x62A; &#x625;&#x644;&#x649; &#x627;&#x644;&#x635;&#x64A;&#x646; &#x644;&#x645; &#x64A;&#x62A;&#x645; &#x627;&#x644;&#x625;&#x628;&#x644;&#x627;&#x63A; &#x639;&#x646;&#x647;&#x627;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x62A;&#x642;&#x648;&#x644;: &quot;&#x62A;&#x623;&#x62E;&#x631;&#x62A; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x641;&#x64A; &#x641;&#x647;&#x645; &#x647;&#x630;&#x627; &#x627;&#x644;&#x623;&#x645;&#x631;&quot;.&lt;/p&gt;
                &lt;p&gt;&quot;&#x625;&#x646;&#x647;&#x627; &#x62A;&#x62A;&#x639;&#x627;&#x631;&#x636; &#x646;&#x648;&#x639;&#x64B;&#x627; &#x645;&#x627; &#x645;&#x639; &#x647;&#x630;&#x647; &#x627;&#x644;&#x641;&#x643;&#x631;&#x629; &#x627;&#x644;&#x642;&#x627;&#x626;&#x644;&#x629; &#x628;&#x623;&#x646; &#x627;&#x644;&#x639;&#x648;&#x644;&#x645;&#x629; &#x642;&#x648;&#x629; &#x645;&#x646; &#x623;&#x62C;&#x644; &#x627;&#x644;&#x62E;&#x64A;&#x631; &#x60C; &#x625;&#x630;&#x627; &#x628;&#x62F;&#x623;&#x62A; &#x628;&#x627;&#x644;&#x642;&#x648;&#x644; &#x60C;&quot; &#x62D;&#x633;&#x646;&#x64B;&#x627; &#x60C; &#x646;&#x62D;&#x62A;&#x627;&#x62C; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62A;&#x62F;&#x642;&#x64A;&#x642; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62B;&#x645;&#x631;&#x64A;&#x646; &#x627;&#x644;&#x623;&#x62C;&#x627;&#x646;&#x628; &quot;.&lt;/p&gt;
                &lt;p&gt;&#x644;&#x643;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x648;&#x627;&#x642;&#x639; &#x60C; &#x62A;&#x63A;&#x64A;&#x631; &#x627;&#x644;&#x639;&#x627;&#x644;&#x645; &#x648;&#x62A;&#x633;&#x62A;&#x63A;&#x644; &#x627;&#x644;&#x635;&#x64A;&#x646; &#x627;&#x644;&#x639;&#x648;&#x644;&#x645;&#x629; &#x644;&#x62A;&#x62D;&#x642;&#x64A;&#x642; &#x645;&#x643;&#x627;&#x633;&#x628;&#x647;&#x627; &#x627;&#x644;&#x62E;&#x627;&#x635;&#x629; &quot;.&lt;/p&gt;
                &lt;p&gt;&#x623;&#x639;&#x644;&#x646;&#x62A; &#x62D;&#x643;&#x648;&#x645;&#x629; &#x62A;&#x64A;&#x631;&#x64A;&#x632;&#x627; &#x645;&#x627;&#x64A; &#x639;&#x646; &#x62E;&#x637;&#x637; &#x644;&#x644;&#x646;&#x638;&#x631; &#x641;&#x64A; &#x647;&#x630;&#x647; &#x627;&#x644;&#x642;&#x636;&#x64A;&#x629; &#x641;&#x64A; &#x639;&#x627;&#x645; 2018.&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x645; &#x627;&#x644;&#x62A;&#x639;&#x647;&#x62F; &#x628;&#x645;&#x634;&#x631;&#x648;&#x639; &#x642;&#x627;&#x646;&#x648;&#x646; &#x64A;&#x639;&#x62F; &#x628;&#x633;&#x644;&#x637;&#x627;&#x62A; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x644;&#x62A;&#x642;&#x64A;&#x64A;&#x645; &#x639;&#x645;&#x644;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x627;&#x646;&#x62F;&#x645;&#x627;&#x62C; &#x648;&#x627;&#x644;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630; &#x641;&#x64A; &#x62E;&#x637;&#x627;&#x628; &#x627;&#x644;&#x645;&#x644;&#x643;&#x629; &#x641;&#x64A; &#x62F;&#x64A;&#x633;&#x645;&#x628;&#x631; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x641;&#x64A; &#x645;&#x627;&#x64A;&#x648; &#x60C; &#x642;&#x627;&#x644; &#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x648;&#x632;&#x631;&#x627;&#x621; &#x628;&#x648;&#x631;&#x64A;&#x633; &#x62C;&#x648;&#x646;&#x633;&#x648;&#x646; &#x625;&#x646; &#x627;&#x644;&#x628;&#x631;&#x644;&#x645;&#x627;&#x646;&#x64A;&#x64A;&#x646; &quot;&#x639;&#x644;&#x649; &#x62D;&#x642; &#x641;&#x64A; &#x627;&#x644;&#x642;&#x644;&#x642;&quot; &#x628;&#x634;&#x623;&#x646; &#x634;&#x631;&#x627;&#x621; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x628;&#x631;&#x64A;&#x637;&#x627;&#x646;&#x64A;&#x629; &#x645;&#x646; &#x642;&#x628;&#x644; &#x62F;&#x648;&#x644; &#x644;&#x62F;&#x64A;&#x647;&#x627; &quot;&#x62F;&#x648;&#x627;&#x641;&#x639; &#x62E;&#x641;&#x64A;&#x629;&quot; &#x60C; &#x648;&#x648;&#x639;&#x62F; &#x628;&#x625;&#x62C;&#x631;&#x627;&#x621;&#x627;&#x62A; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x623;&#x633;&#x627;&#x628;&#x64A;&#x639; &#x627;&#x644;&#x645;&#x642;&#x628;&#x644;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x635;&#x631;&#x641; &#x622;&#x62E;&#x631;&#x648;&#x646; &#x628;&#x627;&#x644;&#x641;&#x639;&#x644;.&lt;/p&gt;
                &lt;p&gt;&#x623;&#x62F;&#x649; &#x634;&#x631;&#x627;&#x621; &#x634;&#x631;&#x643;&#x629; &#x635;&#x64A;&#x646;&#x64A;&#x629; &#x644;&#x62A;&#x635;&#x646;&#x64A;&#x639; &#x627;&#x644;&#x631;&#x648;&#x628;&#x648;&#x62A;&#x627;&#x62A; &#x625;&#x644;&#x649; &#x642;&#x64A;&#x627;&#x645; &#x623;&#x644;&#x645;&#x627;&#x646;&#x64A;&#x627; &#x641;&#x64A; &#x639;&#x627;&#x645; 2017 &#x628;&#x641;&#x631;&#x636; &#x642;&#x64A;&#x648;&#x62F; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x639;&#x644;&#x649; &#x639;&#x645;&#x644;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630;.&lt;/p&gt;
                &lt;p&gt;&#x643;&#x645;&#x627; &#x631;&#x643;&#x632; &#x645;&#x633;&#x624;&#x648;&#x644;&#x648; &#x627;&#x644;&#x645;&#x62E;&#x627;&#x628;&#x631;&#x627;&#x62A; &#x627;&#x644;&#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A;&#x629; &#x628;&#x634;&#x643;&#x644; &#x645;&#x62A;&#x632;&#x627;&#x64A;&#x62F; &#x639;&#x644;&#x649; &#x627;&#x644;&#x628;&#x62D;&#x62B; &#x639;&#x646; &#x64A;&#x62F; &#x62E;&#x641;&#x64A;&#x629; &#x645;&#x646; &#x627;&#x644;&#x62F;&#x648;&#x644;&#x629; &#x627;&#x644;&#x635;&#x64A;&#x646;&#x64A;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x635;&#x641;&#x642;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x62C;&#x627;&#x631;&#x64A;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x642;&#x627;&#x644; &#x628;&#x64A;&#x644; &#x625;&#x64A;&#x641;&#x627;&#x646;&#x64A;&#x646;&#x627; &#x60C; &#x645;&#x62F;&#x64A;&#x631; &#x645;&#x631;&#x643;&#x632; &#x645;&#x643;&#x627;&#x641;&#x62D;&#x629; &#x627;&#x644;&#x62A;&#x62C;&#x633;&#x633; &#x648;&#x627;&#x644;&#x623;&#x645;&#x646; &#x627;&#x644;&#x642;&#x648;&#x645;&#x64A; &#x627;&#x644;&#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A; &#x644;&#x628;&#x64A; &#x628;&#x64A; &#x633;&#x64A; &#x646;&#x64A;&#x648;&#x632;: &quot;&#x642;&#x62F; &#x62A;&#x631;&#x649; &#x639;&#x645;&#x644;&#x64A;&#x629; &#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630; &#x648;&#x64A;&#x628;&#x62F;&#x648; &#x623;&#x646;&#x647;&#x627; &#x62A;&#x628;&#x62F;&#x648; &#x645;&#x646;&#x637;&#x642;&#x64A;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x639;&#x627;&#x644;&#x645;&quot;.&lt;/p&gt;
                &lt;p&gt;&quot;&#x648;&#x644;&#x643;&#x646; &#x64A;&#x62C;&#x628; &#x623;&#x646; &#x62A;&#x643;&#x648;&#x646; &#x647;&#x646;&#x627;&#x643; &#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x633;&#x62A;&#x62E;&#x628;&#x627;&#x631;&#x627;&#x62A;&#x64A;&#x629; &#x62A;&#x639;&#x645;&#x644; &#x639;&#x644;&#x649; &#x62A;&#x642;&#x634;&#x64A;&#x631; &#x62A;&#x644;&#x643; &#x627;&#x644;&#x628;&#x635;&#x644;&#x629; &#x644;&#x62A;&#x62D;&#x62F;&#x64A;&#x62F; &#x623;&#x635;&#x62D;&#x627;&#x628; &#x627;&#x644;&#x623;&#x628;&#x648;&#x627;&#x628; &#x627;&#x644;&#x62E;&#x644;&#x641;&#x64A;&#x629; &#x648;&#x645;&#x645;&#x648;&#x644;&#x64A; &#x639;&#x645;&#x644;&#x64A;&#x629; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630; &#x647;&#x630;&#x647;.&quot;&lt;/p&gt;
                &lt;p&gt;&#x64A;&#x642;&#x648;&#x644; &#x625;&#x64A;&#x641;&#x627;&#x646;&#x64A;&#x646;&#x627; &#x625;&#x646;&#x647; &#x628;&#x639;&#x62F; &#x623;&#x646; &#x643;&#x627;&#x646;&#x62A; &quot;&#x628;&#x637;&#x64A;&#x626;&#x629; &#x628;&#x639;&#x636; &#x627;&#x644;&#x634;&#x64A;&#x621; &#x60C; &#x641;&#x64A; &#x627;&#x644;&#x639;&#x627;&#x645;&#x64A;&#x646; &#x623;&#x648; &#x627;&#x644;&#x62B;&#x644;&#x627;&#x62B;&#x629; &#x623;&#x639;&#x648;&#x627;&#x645; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A;&#x629;&quot; &#x60C; &#x623;&#x635;&#x628;&#x62D;&#x62A; &#x62D;&#x643;&#x648;&#x645;&#x629; &#x627;&#x644;&#x648;&#x644;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x623;&#x643;&#x62B;&#x631; &#x646;&#x634;&#x627;&#x637;&#x64B;&#x627; &#x641;&#x64A; &#x62A;&#x62D;&#x630;&#x64A;&#x631; &#x627;&#x644;&#x642;&#x637;&#x627;&#x639; &#x627;&#x644;&#x62E;&#x627;&#x635;.&lt;/p&gt;
                &lt;p&gt;&#x641;&#x64A; &#x627;&#x644;&#x645;&#x645;&#x644;&#x643;&#x629; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x60C; &#x64A;&#x644;&#x639;&#x628; MI5 &#x62F;&#x648;&#x631;&#x64B;&#x627; &#x645;&#x634;&#x627;&#x628;&#x647;&#x64B;&#x627; &#x648;&#x64A;&#x628;&#x644;&#x63A; &#x627;&#x644;&#x642;&#x631;&#x627;&#x631;&#x627;&#x62A; &#x62D;&#x648;&#x644; &#x645;&#x627; &#x625;&#x630;&#x627; &#x643;&#x627;&#x646;&#x62A; &#x639;&#x645;&#x644;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630; &#x639;&#x644;&#x649; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x635;&#x644;&#x62D;&#x629; &#x627;&#x644;&#x648;&#x637;&#x646;&#x64A;&#x629; - &#x648;&#x644;&#x643;&#x646; &#x62A;&#x645; &#x625;&#x64A;&#x642;&#x627;&#x641; &#x627;&#x644;&#x642;&#x644;&#x64A;&#x644; &#x645;&#x646;&#x647;&#x627;.&lt;/p&gt;
                &lt;h3&gt;&#x645;&#x64A;&#x632;&#x629; &#x627;&#x633;&#x62A;&#x631;&#x627;&#x62A;&#x64A;&#x62C;&#x64A;&#x629;&lt;/h3&gt;
                &lt;p&gt;&#x648;&#x62C;&#x627;&#x621; &#x623;&#x62D;&#x62F; &#x627;&#x644;&#x635;&#x641;&#x648;&#x641; &#x627;&#x644;&#x623;&#x643;&#x62B;&#x631; &#x625;&#x62B;&#x627;&#x631;&#x629; &#x644;&#x644;&#x62F;&#x647;&#x634;&#x629; &#x628;&#x639;&#x62F; &#x623;&#x646; &#x627;&#x634;&#x62A;&#x631;&#x62A; &#x634;&#x631;&#x643;&#x629; &#x635;&#x64A;&#x646;&#x64A;&#x629; &#x645;&#x648;&#x642;&#x639; Grindr &#x644;&#x645;&#x648;&#x627;&#x639;&#x62F;&#x629; &#x627;&#x644;&#x645;&#x62B;&#x644;&#x64A;&#x64A;&#x646;.&lt;/p&gt;
                &lt;p&gt;&lt;img src=&quot;https://ichef.bbci.co.uk/news/624/cpsprodpb/6334/production/_112969352_china.jpg&quot; style=&quot;width: 624px;&quot;&gt;&lt;br&gt;&lt;/p&gt;
                &lt;p&gt;&#x623;&#x62B;&#x627;&#x631;&#x62A; &#x627;&#x644;&#x648;&#x644;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629; &#x645;&#x62E;&#x627;&#x648;&#x641; &#x62A;&#x62A;&#x639;&#x644;&#x642; &#x628;&#x627;&#x644;&#x623;&#x645;&#x646; &#x627;&#x644;&#x642;&#x648;&#x645;&#x64A; &#x628;&#x633;&#x628;&#x628; &#x627;&#x644;&#x62E;&#x648;&#x641; &#x645;&#x646; &#x627;&#x633;&#x62A;&#x62E;&#x62F;&#x627;&#x645; &#x627;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x634;&#x62E;&#x635;&#x64A;&#x629; &#x644;&#x644;&#x62A;&#x63A;&#x644;&#x628; &#x639;&#x644;&#x649; &#x627;&#x644;&#x623;&#x641;&#x631;&#x627;&#x62F; &#x623;&#x648; &#x627;&#x644;&#x62A;&#x623;&#x62B;&#x64A;&#x631; &#x639;&#x644;&#x64A;&#x647;&#x645;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x62A;&#x645; &#x628;&#x64A;&#x639; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x646;&#x647;&#x627;&#x64A;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x642;&#x648;&#x644; &#x628;&#x631;&#x627;&#x648;: &quot;&#x623;&#x62F;&#x631;&#x643;&#x62A; &#x627;&#x644;&#x647;&#x64A;&#x626;&#x629; &#x627;&#x644;&#x62A;&#x646;&#x638;&#x64A;&#x645;&#x64A;&#x629; &#x623;&#x646; &#x627;&#x645;&#x62A;&#x644;&#x627;&#x643; &#x647;&#x630;&#x647; &#x627;&#x644;&#x645;&#x639;&#x644;&#x648;&#x645;&#x627;&#x62A; &#x62A;&#x62D;&#x62A; &#x62A;&#x635;&#x631;&#x641; &#x627;&#x644;&#x62D;&#x643;&#x648;&#x645;&#x629; &#x627;&#x644;&#x635;&#x64A;&#x646;&#x64A;&#x629; &#x643;&#x627;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x646;&#x647;&#x627;&#x64A;&#x629; &#x641;&#x643;&#x631;&#x629; &#x633;&#x64A;&#x626;&#x629; &#x644;&#x644;&#x63A;&#x627;&#x64A;&#x629; &#x628;&#x627;&#x644;&#x646;&#x633;&#x628;&#x629; &#x644;&#x644;&#x623;&#x645;&#x646; &#x627;&#x644;&#x642;&#x648;&#x645;&#x64A; &#x644;&#x644;&#x648;&#x644;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629;&quot;.&lt;/p&gt;
                &lt;p&gt;&quot;&#x646;&#x62D;&#x62A;&#x627;&#x62C; &#x625;&#x644;&#x649; &#x62A;&#x63A;&#x64A;&#x64A;&#x631; &#x641;&#x647;&#x645;&#x646;&#x627; &#x644;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x630;&#x627;&#x62A; &#x627;&#x644;&#x623;&#x647;&#x645;&#x64A;&#x629; &#x627;&#x644;&#x62D;&#x64A;&#x648;&#x64A;&#x629; &#x644;&#x644;&#x623;&#x645;&#x646; &#x627;&#x644;&#x642;&#x648;&#x645;&#x64A; &#x648;&#x627;&#x644;&#x62A;&#x639;&#x627;&#x645;&#x644; &#x645;&#x639;&#x647;&#x627; &#x62A;&#x645;&#x627;&#x645;&#x64B;&#x627; &#x645;&#x62B;&#x644;&#x645;&#x627; &#x62A;&#x639;&#x627;&#x645;&#x644;&#x646;&#x627; &#x645;&#x639; &#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x62F;&#x641;&#x627;&#x639; &#x641;&#x64A; &#x627;&#x644;&#x62D;&#x631;&#x628; &#x627;&#x644;&#x628;&#x627;&#x631;&#x62F;&#x629;&quot;.&lt;/p&gt;
                &lt;p&gt;&#x64A;&#x62A;&#x645;&#x62B;&#x644; &#x623;&#x62D;&#x62F; &#x645;&#x62E;&#x627;&#x648;&#x641; &#x627;&#x644;&#x633;&#x64A;&#x62F; &#x625;&#x64A;&#x641;&#x627;&#x646;&#x64A;&#x646;&#x627; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x62F;&#x649; &#x627;&#x644;&#x630;&#x64A; &#x64A;&#x645;&#x643;&#x646; &#x623;&#x646; &#x62A;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x641;&#x64A;&#x647; &#x627;&#x644;&#x635;&#x64A;&#x646; &#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x645;&#x646; &#x639;&#x645;&#x644;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x627;&#x630; &#x648;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x62E;&#x627;&#x635;&#x629; &#x628;&#x647;&#x627; &#x648;&#x627;&#x644;&#x62A;&#x62C;&#x633;&#x633; &#x627;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A; &#x644;&#x628;&#x646;&#x627;&#x621; &#x642;&#x648;&#x627;&#x639;&#x62F; &#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x643;&#x628;&#x64A;&#x631;&#x629; &#x645;&#x646; &#x627;&#x644;&#x645;&#x639;&#x644;&#x648;&#x645;&#x627;&#x62A; &#x627;&#x644;&#x634;&#x62E;&#x635;&#x64A;&#x629;.&lt;/p&gt;
                &lt;p&gt;&quot;&#x625;&#x646; &#x627;&#x644;&#x642;&#x62F;&#x631;&#x629; &#x639;&#x644;&#x649; &#x627;&#x644;&#x62D;&#x635;&#x648;&#x644; &#x639;&#x644;&#x649; &#x645;&#x639;&#x644;&#x648;&#x645;&#x627;&#x62A; &#x639;&#x646; &#x643;&#x644; &#x625;&#x646;&#x633;&#x627;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x639;&#x627;&#x644;&#x645; &#x644;&#x627; &#x64A;&#x645;&#x62A;&#x644;&#x643;&#x647;&#x627; &#x647;&#x630;&#x627; &#x627;&#x644;&#x625;&#x646;&#x633;&#x627;&#x646; &#x62D;&#x62A;&#x649; &#x639;&#x644;&#x649; &#x646;&#x641;&#x633;&#x647; &#x62A;&#x648;&#x641;&#x631; &#x644;&#x647; &#x645;&#x64A;&#x632;&#x629; &#x625;&#x633;&#x62A;&#x631;&#x627;&#x62A;&#x64A;&#x62C;&#x64A;&#x629; &#x60C; &#x644;&#x64A;&#x633; &#x641;&#x642;&#x637; &#x645;&#x646; &#x645;&#x646;&#x638;&#x648;&#x631; &#x62A;&#x62C;&#x633;&#x633; &#x648;&#x644;&#x643;&#x646; &#x645;&#x646; &#x645;&#x646;&#x638;&#x648;&#x631; &#x62D;&#x644; &#x648;&#x633;&#x637; [&#x648;] &#x641;&#x647;&#x645; &#x62E;&#x637;&#x637; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x648;&#x646;&#x648;&#x627;&#x64A;&#x627;&#x647;&#x627; &#x60C;&quot; &#x647;&#x648; &#x64A;&#x642;&#x648;&#x644;.&lt;/p&gt;
                &lt;p&gt;&lt;i&gt;&#x633;&#x64A;&#x62A;&#x645; &#x628;&#x62B; The New Tech Cold War &#x639;&#x644;&#x649; &#x631;&#x627;&#x62F;&#x64A;&#x648; BBC 4 &#x641;&#x64A; &#x627;&#x644;&#x633;&#x627;&#x639;&#x629; 11:00 &#x64A;&#x648;&#x645; &#x627;&#x644;&#x62C;&#x645;&#x639;&#x629; &#x648;&#x645;&#x631;&#x629; &#x623;&#x62E;&#x631;&#x649; &#x64A;&#x648;&#x645; &#x627;&#x644;&#x62B;&#x644;&#x627;&#x62B;&#x627;&#x621; &#x627;&#x644;&#x633;&#x627;&#x639;&#x629; 16:00&lt;/i&gt;&lt;/p&gt;"),
            "meta_description" => "تخطط حكومة المملكة المتحدة لإجراءات جديدة لتقييد عمليات الاستحواذ الأجنبية لأسباب تتعلق بالأمن القومي.",
            "meta_keyword" => "تقنية, الصين, المملكة المتحدة",
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image4.jpg",
            "post_hits" => 4,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:01",
            "updated_at" => "2022-06-12 00:00:01"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'تقنية'),
            $this->getTagIdByLanguageCode('ar', 'فيسبوك'),
            $this->getTagIdByLanguageCode('ar', 'دونالد ترمب')
        ]);
        $post->translations()->sync([2]);

        # Post Translation Relations 7,8, 9

        Translation::create([
            'id' => 3,
            'value' => json_encode([
                'en' => 7,
                'id' => 8,
                'ar' => 9,
            ])
        ]);

        # 7

        $post = Post::create([
            "id" => 7,
            "post_title" => "Joy Is A Net Of Love By Which You Can Catch Souls",
            "post_name" => "joy-is-a-net-of-love-by-which-you-can-catch-souls",
            "post_content" => html_entity_decode("&lt;p&gt;My first reaction is what beauty? I&amp;rsquo;ve definitely crossed over to the invisible side. I rather prefer it that way&amp;hellip;&lt;/p&gt;&lt;p&gt;My whole life my weight has fluctuated quite a bit and my self-image with it. When I&amp;rsquo;ve been fat, I&amp;rsquo;ve been ugly &amp;mdash; at least in my mind.&lt;/p&gt;&lt;p&gt;I noticed that the more weight I gained, the less teasing or ogling I&amp;rsquo;d get from boys and men. Being fat was safer, damn it. I liked being safe. I hid there.&lt;/p&gt;&lt;p&gt;But at different times I would go on diets and lose weight. That happened in my late twenties, when I went down to what I weighted in sixth grade after the summer diet my grandmother put me on.&lt;/p&gt;&lt;h3&gt;Connecting the dots&lt;/h3&gt;&lt;p&gt;I feel the connection between the colorful visuals and the magical vibrant world I&amp;rsquo;ve created in my writing. The pictures reflect who I am as a creative spirit.&lt;/p&gt;&lt;p&gt;This process has nudged me back from the ledge of self-loathing, especially where photos are concerned. Going forward in my life necessitates being seen in person, on paper, and perhaps even in some forms of media.&lt;/p&gt;&lt;p&gt;Yes, my beauty is about a lot more than gorgeous photos. But if it took seeing myself through Barbara&amp;rsquo;s eyes to get on board with my full, vibrant, impish, playful, radiant self, so be it.&lt;/p&gt;&lt;p&gt;Now that I am &amp;ldquo;out&amp;rdquo; so to speak, it&amp;rsquo;s up to me to feed myself with beautiful images and stories of women close to me in age who are enjoying their fine physical selves and letting others see them through their eyes, not vice versa.&lt;/p&gt;&lt;p&gt;Let&amp;rsquo;s unsubscribe from magazine culture and sign up for honoring ourselves in the full glory of just how good it feels to be alive in our skins, with our eyes, our hair, our unique ways of moving and being and shining.&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image7.jpg",
            "post_hits" => 1,
            "like" => 1,
            "created_at" => "2022-06-12 00:00:02",
            "updated_at" => "2022-06-12 00:00:02"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'United States'),
            $this->getTagIdByLanguageCode('en', 'China'),
            $this->getTagIdByLanguageCode('en', 'Beauty')
        ]);
        $post->translations()->attach(3);

        # 8

        $post = Post::create([
            "id" => 8,
            "post_title" => "Sukacita Adalah Jaring Cinta Yang Dengannya Anda Dapat Menangkap Jiwa",
            "post_name" => "sukacita-adalah-jaring-cinta-yang-dapat-menangkap-jiwa",
            "post_content" => html_entity_decode("&lt;p&gt;Reaksi pertama saya adalah kecantikan apa? Saya pasti telah menyeberang ke sisi yang tidak terlihat. Saya lebih suka seperti itu&mldr;&lt;/p&gt;&lt;p&gt;Sepanjang hidup saya, berat badan saya sedikit berfluktuasi dan citra diri saya dengannya. Ketika saya gemuk, saya jelek &mdash; setidaknya dalam pikiran saya.&lt;/p&gt;&lt;p&gt;Saya perhatikan bahwa semakin berat badan saya bertambah, semakin sedikit ejekan atau ejekan yang saya dapatkan dari anak laki-laki dan laki-laki. Menjadi gemuk lebih aman, sialan. Saya suka merasa aman. Aku bersembunyi di sana.&lt;/p&gt;&lt;p&gt;Tetapi pada waktu yang berbeda saya akan melakukan diet dan menurunkan berat badan. Itu terjadi di usia akhir dua puluhan, ketika saya menurunkan berat badan saya di kelas enam setelah diet musim panas yang diberikan nenek saya.&lt;/p&gt;&lt;h3&gt;Menghubungkan titik-titik&lt;/h3&gt;&lt;p&gt;Saya merasakan hubungan antara visual yang penuh warna dan dunia magis yang semarak yang saya buat dalam tulisan saya. Gambar-gambar tersebut mencerminkan siapa saya sebagai seorang yang berjiwa kreatif.&lt;/p&gt;&lt;p&gt;Proses ini telah mendorong saya kembali dari jurang kebencian diri, terutama dalam hal foto. Melangkah ke depan dalam hidup saya membutuhkan terlihat secara langsung, di atas kertas, dan bahkan mungkin dalam beberapa bentuk media.&lt;/p&gt;&lt;p&gt;Ya, kecantikan saya lebih dari sekadar foto-foto cantik. Tetapi jika perlu melihat diri saya melalui mata Barbara untuk bergabung dengan diri saya yang penuh, bersemangat, nakal, menyenangkan, berseri-seri, biarlah.&lt;/p&gt;&lt;p&gt;Sekarang saya &quot;keluar&quot; sehingga untuk berbicara, terserah saya untuk memberi makan diri saya sendiri dengan gambar-gambar indah dan kisah-kisah wanita yang dekat dengan saya di usia yang menikmati diri fisik mereka yang baik dan membiarkan orang lain melihat mereka melalui mata mereka, bukan sebaliknya.&lt;/p&gt;&lt;p&gt;Mari berhenti berlangganan dari budaya majalah dan mendaftar untuk menghormati diri kita sendiri dalam kemuliaan penuh betapa menyenangkan rasanya hidup di kulit kita, dengan mata kita, rambut kita, cara unik kita bergerak dan menjadi dan bersinar.&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image7.jpg",
            "post_hits" => 3,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:02",
            "updated_at" => "2022-06-12 00:00:02"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Teknologi'),
            $this->getTagIdByLanguageCode('id', 'United States'),
            $this->getTagIdByLanguageCode('id', 'China'),
            $this->getTagIdByLanguageCode('id', 'Kecantikan'),
        ]);
        $post->translations()->attach(3);

        # 9

        $post = Post::create([
            "id" => 9,
            "post_title" => "الفرح هو شبكة الحب التي يمكنك من خلالها التقاط النفوس",
            "post_name" => "lfrh-ho-shbk-lhb-lty-ymknk-mn-khl-lh-ltk-t-lnfos",
            "post_content" => html_entity_decode("&lt;p&gt;&#x623;&#x648;&#x644; &#x631;&#x62F; &#x641;&#x639;&#x644; &#x644;&#x64A; &#x647;&#x648; &#x645;&#x627; &#x627;&#x644;&#x62C;&#x645;&#x627;&#x644;&#x61F; &#x644;&#x642;&#x62F; &#x639;&#x628;&#x631;&#x62A; &#x628;&#x627;&#x644;&#x62A;&#x623;&#x643;&#x64A;&#x62F; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62C;&#x627;&#x646;&#x628; &#x63A;&#x64A;&#x631; &#x627;&#x644;&#x645;&#x631;&#x626;&#x64A;. &#x623;&#x641;&#x636;&#x644; &#x630;&#x644;&#x643; &#x628;&#x647;&#x630;&#x647; &#x627;&#x644;&#x637;&#x631;&#x64A;&#x642;&#x629; ...&lt;br&gt;&lt;/p&gt;&lt;p&gt;&#x637;&#x648;&#x627;&#x644; &#x62D;&#x64A;&#x627;&#x62A;&#x64A; &#x60C; &#x62A;&#x630;&#x628;&#x630;&#x628; &#x648;&#x632;&#x646;&#x64A; &#x642;&#x644;&#x64A;&#x644;&#x627;&#x64B; &#x648;&#x635;&#x648;&#x631;&#x62A;&#x64A; &#x627;&#x644;&#x630;&#x627;&#x62A;&#x64A;&#x629; &#x645;&#x639;&#x647;. &#x639;&#x646;&#x62F;&#x645;&#x627; &#x643;&#x646;&#x62A; &#x633;&#x645;&#x64A;&#x646;&#x64B;&#x627; &#x60C; &#x643;&#x646;&#x62A; &#x642;&#x628;&#x64A;&#x62D;&#x64B;&#x627; - &#x639;&#x644;&#x649; &#x627;&#x644;&#x623;&#x642;&#x644; &#x641;&#x64A; &#x630;&#x647;&#x646;&#x64A;.&lt;/p&gt;&lt;p&gt;&#x644;&#x642;&#x62F; &#x644;&#x627;&#x62D;&#x638;&#x62A; &#x623;&#x646;&#x647; &#x643;&#x644;&#x645;&#x627; &#x632;&#x627;&#x62F; &#x648;&#x632;&#x646;&#x64A; &#x60C; &#x643;&#x644;&#x645;&#x627; &#x642;&#x644;&#x62A; &#x645;&#x636;&#x627;&#x64A;&#x642;&#x627;&#x62A;&#x64A; &#x623;&#x648; &#x62A;&#x642;&#x647;&#x642;&#x62A;&#x64A; &#x645;&#x646; &#x627;&#x644;&#x641;&#x62A;&#x64A;&#x627;&#x646; &#x648;&#x627;&#x644;&#x631;&#x62C;&#x627;&#x644;. &#x643;&#x648;&#x646;&#x643; &#x628;&#x62F;&#x64A;&#x646;&#x64B;&#x627; &#x643;&#x627;&#x646; &#x623;&#x643;&#x62B;&#x631; &#x623;&#x645;&#x627;&#x646;&#x64B;&#x627; &#x60C; &#x627;&#x644;&#x644;&#x639;&#x646;&#x629;. &#x623;&#x62D;&#x628;&#x628;&#x62A; &#x623;&#x646; &#x623;&#x643;&#x648;&#x646; &#x622;&#x645;&#x646;&#x64B;&#x627;. &#x627;&#x62E;&#x62A;&#x628;&#x623;&#x62A; &#x647;&#x646;&#x627;&#x643;.&lt;/p&gt;&lt;p&gt;&#x644;&#x643;&#x646; &#x641;&#x64A; &#x623;&#x648;&#x642;&#x627;&#x62A; &#x645;&#x62E;&#x62A;&#x644;&#x641;&#x629; &#x643;&#x646;&#x62A; &#x623;&#x62A;&#x628;&#x639; &#x646;&#x638;&#x627;&#x645;&#x64B;&#x627; &#x63A;&#x630;&#x627;&#x626;&#x64A;&#x64B;&#x627; &#x648;&#x623;&#x641;&#x642;&#x62F; &#x627;&#x644;&#x648;&#x632;&#x646;. &#x62D;&#x62F;&#x62B; &#x630;&#x644;&#x643; &#x641;&#x64A; &#x623;&#x648;&#x627;&#x62E;&#x631; &#x627;&#x644;&#x639;&#x634;&#x631;&#x64A;&#x646;&#x627;&#x62A; &#x645;&#x646; &#x639;&#x645;&#x631;&#x64A; &#x60C; &#x639;&#x646;&#x62F;&#x645;&#x627; &#x646;&#x632;&#x644;&#x62A; &#x625;&#x644;&#x649; &#x645;&#x627; &#x643;&#x627;&#x646; &#x648;&#x632;&#x646;&#x64A; &#x641;&#x64A; &#x627;&#x644;&#x635;&#x641; &#x627;&#x644;&#x633;&#x627;&#x62F;&#x633; &#x628;&#x639;&#x62F; &#x627;&#x644;&#x646;&#x638;&#x627;&#x645; &#x627;&#x644;&#x63A;&#x630;&#x627;&#x626;&#x64A; &#x627;&#x644;&#x635;&#x64A;&#x641;&#x64A; &#x627;&#x644;&#x630;&#x64A; &#x648;&#x636;&#x639;&#x62A;&#x646;&#x64A; &#x62C;&#x62F;&#x62A;&#x64A; &#x639;&#x644;&#x64A;&#x647;.&lt;/p&gt;&lt;h3&gt;&#x62A;&#x648;&#x635;&#x64A;&#x644; &#x627;&#x644;&#x646;&#x642;&#x627;&#x637;&lt;/h3&gt;&lt;p&gt;&#x623;&#x634;&#x639;&#x631; &#x628;&#x627;&#x644;&#x627;&#x631;&#x62A;&#x628;&#x627;&#x637; &#x628;&#x64A;&#x646; &#x627;&#x644;&#x645;&#x631;&#x626;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x644;&#x648;&#x646;&#x629; &#x648;&#x627;&#x644;&#x639;&#x627;&#x644;&#x645; &#x627;&#x644;&#x633;&#x62D;&#x631;&#x64A; &#x627;&#x644;&#x646;&#x627;&#x628;&#x636; &#x628;&#x627;&#x644;&#x62D;&#x64A;&#x627;&#x629; &#x627;&#x644;&#x630;&#x64A; &#x62E;&#x644;&#x642;&#x62A;&#x647; &#x641;&#x64A; &#x643;&#x62A;&#x627;&#x628;&#x627;&#x62A;&#x64A;. &#x62A;&#x639;&#x643;&#x633; &#x627;&#x644;&#x635;&#x648;&#x631; &#x645;&#x646; &#x623;&#x646;&#x627; &#x643;&#x631;&#x648;&#x62D; &#x625;&#x628;&#x62F;&#x627;&#x639;&#x64A;&#x629;.&lt;/p&gt;&lt;p&gt;&#x62F;&#x641;&#x639;&#x62A;&#x646;&#x64A; &#x647;&#x630;&#x647; &#x627;&#x644;&#x639;&#x645;&#x644;&#x64A;&#x629; &#x625;&#x644;&#x649; &#x627;&#x644;&#x639;&#x648;&#x62F;&#x629; &#x645;&#x646; &#x62D;&#x627;&#x641;&#x629; &#x627;&#x644;&#x643;&#x631;&#x627;&#x647;&#x64A;&#x629; &#x627;&#x644;&#x630;&#x627;&#x62A;&#x64A;&#x629; &#x60C; &#x62E;&#x627;&#x635;&#x629;&#x64B; &#x639;&#x646;&#x62F;&#x645;&#x627; &#x64A;&#x62A;&#x639;&#x644;&#x642; &#x627;&#x644;&#x623;&#x645;&#x631; &#x628;&#x627;&#x644;&#x635;&#x648;&#x631;. &#x64A;&#x62A;&#x637;&#x644;&#x628; &#x627;&#x644;&#x645;&#x636;&#x64A; &#x642;&#x62F;&#x645;&#x64B;&#x627; &#x641;&#x64A; &#x62D;&#x64A;&#x627;&#x62A;&#x64A; &#x623;&#x646; &#x623;&#x631;&#x649; &#x634;&#x62E;&#x635;&#x64A;&#x64B;&#x627; &#x60C; &#x639;&#x644;&#x649; &#x627;&#x644;&#x648;&#x631;&#x642; &#x60C; &#x648;&#x631;&#x628;&#x645;&#x627; &#x62D;&#x62A;&#x649; &#x641;&#x64A; &#x628;&#x639;&#x636; &#x648;&#x633;&#x627;&#x626;&#x644; &#x627;&#x644;&#x625;&#x639;&#x644;&#x627;&#x645;.&lt;/p&gt;&lt;p&gt;&#x646;&#x639;&#x645; &#x60C; &#x625;&#x646; &#x62C;&#x645;&#x627;&#x644;&#x64A; &#x64A;&#x62A;&#x639;&#x644;&#x642; &#x628;&#x623;&#x643;&#x62B;&#x631; &#x645;&#x646; &#x645;&#x62C;&#x631;&#x62F; &#x635;&#x648;&#x631; &#x631;&#x627;&#x626;&#x639;&#x629;. &#x648;&#x644;&#x643;&#x646; &#x625;&#x630;&#x627; &#x643;&#x627;&#x646; &#x627;&#x644;&#x623;&#x645;&#x631; &#x64A;&#x62A;&#x637;&#x644;&#x628; &#x631;&#x624;&#x64A;&#x629; &#x646;&#x641;&#x633;&#x64A; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x639;&#x64A;&#x646;&#x64A; &#x628;&#x627;&#x631;&#x628;&#x631;&#x627; &#x644;&#x644;&#x627;&#x646;&#x636;&#x645;&#x627;&#x645; &#x625;&#x644;&#x649; &#x630;&#x627;&#x62A;&#x64A; &#x627;&#x644;&#x643;&#x627;&#x645;&#x644;&#x629; &#x648;&#x627;&#x644;&#x646;&#x627;&#x628;&#x636;&#x629; &#x628;&#x627;&#x644;&#x62D;&#x64A;&#x627;&#x629; &#x648;&#x627;&#x644;&#x634;&#x631;&#x642;&#x64A;&#x629; &#x648;&#x627;&#x644;&#x645;&#x631;&#x62D;&#x629; &#x648;&#x627;&#x644;&#x645;&#x634;&#x631;&#x642;&#x629; &#x60C; &#x641;&#x644;&#x64A;&#x643;&#x646; &#x627;&#x644;&#x623;&#x645;&#x631; &#x643;&#x630;&#x644;&#x643;.&lt;/p&gt;&lt;p&gt;&#x627;&#x644;&#x622;&#x646; &#x628;&#x639;&#x62F; &#x623;&#x646; &#x62C;&#x626;&#x62A; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62E;&#x627;&#x631;&#x62C; &#x625;&#x630;&#x627; &#x62C;&#x627;&#x632; &#x627;&#x644;&#x62A;&#x639;&#x628;&#x64A;&#x631; &#x60C; &#x641;&#x625;&#x646; &#x627;&#x644;&#x623;&#x645;&#x631; &#x645;&#x62A;&#x631;&#x648;&#x643; &#x644;&#x64A; &#x644;&#x625;&#x637;&#x639;&#x627;&#x645; &#x646;&#x641;&#x633;&#x64A; &#x628;&#x627;&#x644;&#x635;&#x648;&#x631; &#x648;&#x627;&#x644;&#x642;&#x635;&#x635; &#x627;&#x644;&#x62C;&#x645;&#x64A;&#x644;&#x629; &#x644;&#x646;&#x633;&#x627;&#x621; &#x645;&#x642;&#x631;&#x628;&#x627;&#x62A; &#x645;&#x646;&#x64A; &#x641;&#x64A; &#x627;&#x644;&#x633;&#x646; &#x627;&#x644;&#x644;&#x627;&#x626;&#x64A; &#x64A;&#x633;&#x62A;&#x645;&#x62A;&#x639;&#x646; &#x628;&#x623;&#x646;&#x641;&#x633;&#x647;&#x646; &#x627;&#x644;&#x62C;&#x633;&#x62F;&#x64A;&#x629; &#x627;&#x644;&#x62C;&#x64A;&#x62F;&#x629; &#x648;&#x64A;&#x633;&#x645;&#x62D;&#x648;&#x646; &#x644;&#x644;&#x622;&#x62E;&#x631;&#x64A;&#x646; &#x628;&#x631;&#x624;&#x64A;&#x62A;&#x647;&#x645; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x623;&#x639;&#x64A;&#x646;&#x647;&#x645; &#x60C; &#x648;&#x644;&#x64A;&#x633; &#x627;&#x644;&#x639;&#x643;&#x633;.&lt;/p&gt;&lt;p&gt;&#x62F;&#x639;&#x646;&#x627; &#x646;&#x644;&#x63A;&#x64A; &#x627;&#x644;&#x627;&#x634;&#x62A;&#x631;&#x627;&#x643; &#x641;&#x64A; &#x62B;&#x642;&#x627;&#x641;&#x629; &#x627;&#x644;&#x645;&#x62C;&#x644;&#x627;&#x62A; &#x648;&#x627;&#x634;&#x62A;&#x631;&#x643; &#x641;&#x64A; &#x62A;&#x643;&#x631;&#x64A;&#x645; &#x623;&#x646;&#x641;&#x633;&#x646;&#x627; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x62C;&#x62F; &#x627;&#x644;&#x643;&#x627;&#x645;&#x644; &#x644;&#x645;&#x62F;&#x649; &#x634;&#x639;&#x648;&#x631;&#x646;&#x627; &#x628;&#x627;&#x644;&#x631;&#x636;&#x627; &#x639;&#x646; &#x627;&#x644;&#x62D;&#x64A;&#x627;&#x629; &#x641;&#x64A; &#x628;&#x634;&#x631;&#x62A;&#x646;&#x627; &#x60C; &#x628;&#x623;&#x639;&#x64A;&#x646;&#x646;&#x627; &#x648;&#x634;&#x639;&#x631;&#x646;&#x627; &#x648;&#x637;&#x631;&#x642;&#x646;&#x627; &#x627;&#x644;&#x641;&#x631;&#x64A;&#x62F;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x62D;&#x631;&#x643;&#x629; &#x648;&#x627;&#x644;&#x648;&#x62C;&#x648;&#x62F; &#x648;&#x627;&#x644;&#x62A;&#x623;&#x644;&#x642;.&lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image7.jpg",
            "post_hits" => 1,
            "like" => 1,
            "created_at" => "2022-06-12 00:00:03",
            "updated_at" => "2022-06-12 00:00:03"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'أخبار'),
            $this->getTagIdByLanguageCode('ar', 'الولايات المتحدة الأمريكية'),
            $this->getTagIdByLanguageCode('ar', 'الصين'),
            $this->getTagIdByLanguageCode('ar', 'جمال'),
        ]);
        $post->translations()->sync([3]);

        # Post Translation Relations 10,11, 12

        Translation::create([
            'id' => 4,
            'value' => json_encode([
                'en' => 10,
                'id' => 11,
                'ar' => 12,
            ])
        ]);

        # 10

        $post = Post::create([
            "id" => 10,
            "post_title" => "The World Caters To Average People And Mediocre Lifestyles",
            "post_name" => "the-world-caters-to-average-people-and-mediocre-lifestyles",
            "post_content" => html_entity_decode("&lt;p&gt;Tolerably much and ouch the in began alas more ouch some then accommodating flimsy wholeheartedly after hello slightly the that cow pouted much a goodness bound rebuilt poetically jaguar groundhog.&lt;/p&gt;&lt;h3&gt;Design is future&lt;/h3&gt;&lt;p&gt;Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.&lt;/p&gt;&lt;p&gt;Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.&lt;/p&gt;&lt;p&gt;Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted flirtatiously as beaver beheld above forward energetic across this jeepers beneficently cockily less a the raucously that magic upheld far so the this where crud then below after jeez enchanting drunkenly more much wow callously irrespective limpet.&lt;/p&gt;&lt;p&gt;Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively dachshund.&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;The advance of technology is based on making it fit in so that you don&apos;t really even notice it, so it&apos;s part of everyday life.&lt;br&gt;B. Johnso&lt;/blockquote&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image10.jpg",
            "post_hits" => 5,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:03",
            "updated_at" => "2022-06-12 00:00:03"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Beauty'),
            $this->getTagIdByLanguageCode('en', 'Fashion'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle')
        ]);
        $post->translations()->attach(4);

        # 11

        $post = Post::create([
            "id" => 11,
            "post_title" => "Dunia Melayani Orang Biasa dan Gaya Hidup Biasa-biasa saja",
            "post_name" => "dunia-melayani-orang-biasa-dan-gaya-hidup-biasa-biasa-saja",
            "post_content" => html_entity_decode("&lt;p&gt;lumayan banyak dan aduh di mulai sayangnya lebih aduh beberapa kemudian menampung tipis sepenuh hati setelah halo sedikit sapi yang cemberut banyak kebaikan terikat dibangun kembali puitis jaguar groundhog.&lt;/p&gt;&lt;h3&gt;Desain adalah masa depan&lt;/h3&gt;&lt;p&gt;Disewa secara fisik tanpa hambatan bermain di rengekan sayang gorila koala tergantung dan banyak yikes dari jauh quetzal kebaikan dan dari untuk kebaikan meringis tidak bertanggung jawab dan meadowlark dekat kerang penting unblushingly erat neurotik lapar beberapa dan sayang mati-matian ini terpisah.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Tercecer sempit yikes meninggalkan ngengat di yikes membungkuk ini yang grizzly banyak halo di sendok-makan yang sayangnya memikirkan kembali banyak sopan kaya dan wow terhadap sering lancar di tangguh dapat diterima mengepak di samping dan jauh sekitar pedesaan hey mastodon goldfinch genting kebaikan menggerogoti ubur-ubur dan satu namun karena.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Singkat mendengar woodchuck sayang wow berang-berang yang sangat kencang ini hei halo jauh meadowlark meniru dengan mengerikan memeluk yang yikes minimal bulat cemberut genit saat berang-berang terlihat di atas maju energik melintasi jeeper ini murah hati sombong kurang parau sihir yang ditegakkan sejauh ini di mana kasar kemudian di bawah setelah jeez mempesona mabuk lebih banyak wow tanpa perasaan terlepas limpet.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Scallop atau jauh kasar dataran sangat jauh sejauh ini iguana cabul dewasa sebelum waktunya dan dan lebih sedikit ular berbisa sebaliknya caustic wow dekat ini sayangnya dan berikutnya dan memohon yikes mengartikulasikan sebagai dalmatian kurang terkekeh apalagi mengejek untuk terima kasih membabi buta merintih kurang di obyektif fantastis meringis liar beberapa jip wow dan mawar tumbuh lebih besar dari dachshund yang lugubrious seram irasional menarik.&lt;/span&gt;&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;Kemajuan teknologi didasarkan pada penyesuaian sehingga Anda tidak benar-benar menyadarinya, jadi itu adalah bagian dari kehidupan sehari-hari.&lt;br&gt;B. Johnso&lt;/blockquote&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image10.jpg",
            "post_hits" => 1,
            "like" => 1,
            "created_at" => "2022-06-12 00:00:03",
            "updated_at" => "2022-06-12 00:00:03"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Teknologi'),
            $this->getTagIdByLanguageCode('id', 'Kecantikan'),
            $this->getTagIdByLanguageCode('id', 'Mode'),
            $this->getTagIdByLanguageCode('id', 'Gaya Hidup'),
        ]);
        $post->translations()->attach(4);

        # 12

        $post = Post::create([
            "id" => 12,
            "post_title" => "يلبي العالم احتياجات الناس العاديين وأنماط الحياة المتواضعة",
            "post_name" => "ylby-laa-lm-hty-g-t-ln-s-laa-dyyn-oanm-t-lhy-lmto-daa",
            "post_content" => html_entity_decode("&lt;p&gt;&#x628;&#x634;&#x643;&#x644; &#x645;&#x62D;&#x62A;&#x645;&#x644; &#x60C; &#x628;&#x62F;&#x623; &#x627;&#x644;&#x643;&#x62B;&#x64A;&#x631; &#x645;&#x646; &#x627;&#x644;&#x623;&#x634;&#x62E;&#x627;&#x635; &#x644;&#x644;&#x623;&#x633;&#x641; &#x623;&#x643;&#x62B;&#x631; &#x645;&#x646; &#x630;&#x644;&#x643; &#x60C; &#x62B;&#x645; &#x627;&#x633;&#x62A;&#x648;&#x639;&#x628;&#x648;&#x627; &#x636;&#x639;&#x64A;&#x641;&#x64B;&#x627; &#x645;&#x646; &#x635;&#x645;&#x64A;&#x645; &#x627;&#x644;&#x642;&#x644;&#x628; &#x628;&#x639;&#x62F; &#x645;&#x631;&#x62D;&#x628;&#x64B;&#x627; &#x642;&#x644;&#x64A;&#x644;&#x627;&#x64B; &#x62A;&#x644;&#x643; &#x627;&#x644;&#x628;&#x642;&#x631;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x639;&#x628;&#x633;&#x62A; &#x627;&#x644;&#x643;&#x62B;&#x64A;&#x631; &#x645;&#x646; &#x627;&#x644;&#x62E;&#x64A;&#x631; &#x627;&#x644;&#x645;&#x644;&#x632;&#x645; &#x628;&#x625;&#x639;&#x627;&#x62F;&#x629; &#x628;&#x646;&#x627;&#x621; &#x62C;&#x631;&#x630; &#x627;&#x644;&#x623;&#x631;&#x636; &#x62C;&#x627;&#x643;&#x648;&#x627;&#x631; &#x634;&#x639;&#x631;&#x64A;&#x64B;&#x627;.&lt;/p&gt;
                &lt;h3&gt;&#x627;&#x644;&#x62A;&#x635;&#x645;&#x64A;&#x645; &#x647;&#x648; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x642;&#x628;&#x644;&lt;/h3&gt;
                &lt;p&gt;&#x63A;&#x64A;&#x631; &#x627;&#x644;&#x645;&#x642;&#x64A;&#x651;&#x62F; &#x627;&#x644;&#x645;&#x623;&#x62C;&#x648;&#x631; &#x62C;&#x633;&#x62F;&#x64A;&#x64B;&#x627; &#x64A;&#x644;&#x639;&#x628; &#x641;&#x64A; &#x63A;&#x648;&#x631;&#x64A;&#x644;&#x627; &#x643;&#x648;&#x627;&#x644;&#x627; &#x627;&#x644;&#x63A;&#x648;&#x631;&#x64A;&#x644;&#x627; &#x627;&#x644;&#x63A;&#x627;&#x644;&#x64A; &#x60C; &#x648;&#x64A;&#x639;&#x62A;&#x645;&#x62F; &#x643;&#x62B;&#x64A;&#x631;&#x64B;&#x627; &#x639;&#x644;&#x649; &#x627;&#x644;&#x62E;&#x64A;&#x631; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627; &#x639;&#x646; &#x627;&#x644;&#x643;&#x64A;&#x62A;&#x632;&#x627;&#x644; &#x648;&#x645;&#x646; &#x623;&#x62C;&#x644; &#x627;&#x644;&#x62E;&#x64A;&#x631; &#x627;&#x644;&#x643;&#x626;&#x64A;&#x628; &#x627;&#x644;&#x630;&#x64A; &#x644;&#x627; &#x64A;&#x645;&#x643;&#x646; &#x62A;&#x641;&#x633;&#x64A;&#x631;&#x647; &#x648;&#x627;&#x644;&#x645;&#x631;&#x62C; &#x628;&#x627;&#x644;&#x642;&#x631;&#x628; &#x645;&#x646; &#x627;&#x644;&#x625;&#x633;&#x643;&#x627;&#x644;&#x648;&#x628; &#x627;&#x644;&#x62D;&#x627;&#x633;&#x645; &#x627;&#x644;&#x630;&#x64A; &#x644;&#x627; &#x64A;&#x644;&#x64A;&#x646; &#x60C; &#x648;&#x647;&#x648; &#x639;&#x635;&#x628;&#x64A; &#x634;&#x62F;&#x64A;&#x62F; &#x627;&#x644;&#x62C;&#x648;&#x639; &#x648;&#x639;&#x632;&#x64A;&#x632;&#x64A; &#x628;&#x634;&#x62F;&#x629; &#x639;&#x644;&#x649; &#x647;&#x630;&#x627; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627;.&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x646;&#x62D;&#x646;&#x64A; &#x627;&#x644;&#x641;&#x631;&#x627;&#x634;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x643;&#x627;&#x646;&#x62A; &#x62A;&#x62A;&#x623;&#x631;&#x62C;&#x62D; &#x628;&#x635;&#x639;&#x648;&#x628;&#x629; &#x636;&#x64A;&#x642;&#x629; &#x641;&#x64A; yikes &#x647;&#x630;&#x627; &#x627;&#x644;&#x623;&#x645;&#x631; &#x627;&#x644;&#x630;&#x64A; &#x623;&#x634;&#x64A;&#x628; &#x643;&#x62B;&#x64A;&#x631;&#x64B;&#x627; &#x645;&#x631;&#x62D;&#x628;&#x64B;&#x627; &#x639;&#x644;&#x649; &#x627;&#x644;&#x645;&#x644;&#x639;&#x642;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x623;&#x639;&#x64A;&#x62F; &#x627;&#x644;&#x62A;&#x641;&#x643;&#x64A;&#x631; &#x641;&#x64A;&#x647;&#x627; &#x628;&#x634;&#x643;&#x644; &#x644;&#x627;&#x626;&#x642; &#x648;&#x63A;&#x646;&#x64A;&#x64B;&#x627; &#x636;&#x62F; &#x627;&#x644;&#x633;&#x648;&#x627;&#x626;&#x644; &#x627;&#x644;&#x645;&#x62A;&#x643;&#x631;&#x631;&#x629; &#x628;&#x634;&#x643;&#x644; &#x631;&#x627;&#x626;&#x639; &#x648;&#x645;&#x642;&#x628;&#x648;&#x644; &#x625;&#x644;&#x649; &#x62C;&#x627;&#x646;&#x628; &#x630;&#x644;&#x643; &#x648;&#x628;&#x627;&#x644;&#x643;&#x62B;&#x64A;&#x631; &#x62A;&#x642;&#x631;&#x64A;&#x628;&#x64B;&#x627; &#x641;&#x648;&#x642; &#x627;&#x644;&#x62D;&#x633;&#x648;&#x646; &#x63A;&#x64A;&#x631; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x642;&#x631; &#x645;&#x646; &#x627;&#x644;&#x646;&#x627;&#x62D;&#x64A;&#x629; &#x627;&#x644;&#x62C;&#x64A;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x629; &#x637;&#x627;&#x626;&#x631; &#x627;&#x644;&#x62D;&#x633;&#x648;&#x646; &#x627;&#x644;&#x637;&#x64A;&#x628; &#x627;&#x644;&#x630;&#x64A; &#x623;&#x635;&#x627;&#x628; &#x642;&#x646;&#x62F;&#x64A;&#x644; &#x627;&#x644;&#x628;&#x62D;&#x631; &#x648; &#x644;&#x643;&#x646; &#x628;&#x633;&#x628;&#x628; &#x648;&#x627;&#x62D;&#x62F;.&lt;/p&gt;
                &lt;p&gt;&#x633;&#x645;&#x639; &#x644;&#x627;&#x643;&#x648;&#x646;&#x64A;&#x643; &#x639;&#x632;&#x64A;&#x632;&#x64A; &#x627;&#x644;&#x642;&#x646;&#x62F;&#x633; &#x627;&#x644;&#x645;&#x634;&#x62F;&#x648;&#x62F; &#x60C; &#x64A;&#x630;&#x647;&#x644; &#x647;&#x630;&#x627; &#x627;&#x644;&#x642;&#x646;&#x62F;&#x633; &#x627;&#x644;&#x645;&#x634;&#x62F;&#x648;&#x62F; &#x628;&#x634;&#x643;&#x644; &#x641;&#x638;&#x64A;&#x639; &#x60C; &#x645;&#x631;&#x62D;&#x628;&#x64B;&#x627; &#x628;&#x639;&#x64A;&#x62F; &#x627;&#x644;&#x645;&#x631;&#x648;&#x62C; &#x60C; &#x639;&#x627;&#x646;&#x642; &#x628;&#x634;&#x643;&#x644; &#x641;&#x627;&#x636;&#x62D; &#x644;&#x62F;&#x631;&#x62C;&#x629; &#x623;&#x646; &#x627;&#x644;&#x642;&#x646;&#x62F;&#x633; &#x643;&#x627;&#x646; &#x628;&#x627;&#x644;&#x625;&#x62C;&#x645;&#x627;&#x639; &#x64A;&#x639;&#x628;&#x633; &#x628;&#x634;&#x643;&#x644; &#x63A;&#x632;&#x644;&#x64A; &#x643;&#x645;&#x627; &#x643;&#x627;&#x646; &#x627;&#x644;&#x642;&#x646;&#x62F;&#x633; &#x64A;&#x646;&#x638;&#x631; &#x625;&#x644;&#x649; &#x627;&#x644;&#x623;&#x645;&#x627;&#x645; &#x646;&#x634;&#x64A;&#x637;&#x64B;&#x627; &#x639;&#x628;&#x631; &#x647;&#x630;&#x627; &#x627;&#x644;&#x62C;&#x64A;&#x628;&#x64A;&#x631; &#x628;&#x634;&#x643;&#x644; &#x62C;&#x64A;&#x62F; &#x623;&#x642;&#x644; &#x645;&#x646; &#x630;&#x644;&#x643; &#x627;&#x644;&#x633;&#x62D;&#x631; &#x627;&#x644;&#x635;&#x627;&#x62E;&#x628; &#x627;&#x644;&#x630;&#x64A; &#x62A;&#x645; &#x627;&#x644;&#x62A;&#x645;&#x633;&#x643; &#x628;&#x647; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627; &#x633;&#x627;&#x62D;&#x631; &#x641;&#x64A; &#x62D;&#x627;&#x644;&#x629; &#x633;&#x643;&#x631; &#x623;&#x643;&#x62B;&#x631; &#x646;&#x62C;&#x627;&#x62D;&#x64B;&#x627; &#x628;&#x641;&#x638;&#x627;&#x638;&#x629; &#x628;&#x63A;&#x636; &#x627;&#x644;&#x646;&#x638;&#x631; &#x639;&#x646; &#x627;&#x644;&#x644;&#x627;&#x645;&#x628;&#x627;&#x644;&#x627;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x627;&#x644;&#x625;&#x633;&#x643;&#x627;&#x644;&#x648;&#x628; &#x623;&#x648; &#x627;&#x644;&#x62E;&#x627;&#x645; &#x627;&#x644;&#x628;&#x633;&#x64A;&#x637; &#x628;&#x634;&#x643;&#x644; &#x645;&#x644;&#x62D;&#x648;&#x638; &#x62D;&#x62A;&#x649; &#x627;&#x644;&#x622;&#x646; &#x627;&#x644;&#x625;&#x63A;&#x648;&#x627;&#x646;&#x627; &#x627;&#x644;&#x628;&#x630;&#x64A;&#x626;&#x629; &#x642;&#x628;&#x644; &#x627;&#x644;&#x646;&#x636;&#x648;&#x62C; &#x648;&#x623;&#x642;&#x644; &#x627;&#x644;&#x623;&#x641;&#x639;&#x649; &#x627;&#x644;&#x62E;&#x634;&#x62E;&#x634;&#x629; &#x627;&#x644;&#x645;&#x639;&#x627;&#x643;&#x633;&#x629; &#x644;&#x644;&#x643;&#x627;&#x648;&#x64A;&#x629; &#x60C; &#x648;&#x627;&#x648; &#x647;&#x630;&#x627; &#x642;&#x631;&#x64A;&#x628;&#x64B;&#x627; &#x644;&#x644;&#x623;&#x633;&#x641; &#x648;&#x628;&#x639;&#x62F; &#x630;&#x644;&#x643; &#x648;&#x62A;&#x639;&#x647;&#x62F; &#x623;&#x646; &#x627;&#x644;&#x635;&#x639;&#x627;&#x628; &#x62A;&#x62A;&#x62C;&#x644;&#x649; &#x639;&#x644;&#x649; &#x623;&#x646;&#x647;&#x627; &#x623;&#x642;&#x644; &#x62F;&#x644;&#x645;&#x627;&#x633;&#x64A;&#x64B;&#x627; &#x641;&#x64A; &#x62D;&#x627;&#x644;&#x629; &#x627;&#x633;&#x62A;&#x647;&#x632;&#x627;&#x621; &#x623;&#x642;&#x644; &#x644;&#x623;&#x646; &#x627;&#x644;&#x634;&#x643;&#x631; &#x627;&#x644;&#x639;&#x627;&#x637;&#x641;&#x64A; &#x627;&#x644;&#x623;&#x639;&#x645;&#x649; &#x643;&#x627;&#x646; &#x623;&#x642;&#x644; &#x639;&#x628;&#x631; &#x62E;&#x64A;&#x627;&#x644;&#x64A; &#x645;&#x648;&#x636;&#x648;&#x639;&#x64A; &#x643;&#x634;&#x631;&#x648;&#x627; &#x628;&#x639;&#x646;&#x641; &#x628;&#x639;&#x646;&#x641; &#x628;&#x639;&#x636; &#x633;&#x64A;&#x627;&#x631;&#x627;&#x62A; &#x627;&#x644;&#x62C;&#x64A;&#x628; &#x627;&#x644;&#x645;&#x628;&#x647;&#x631;&#x629; &#x648;&#x627;&#x644;&#x648;&#x631;&#x62F;&#x64A;&#x629; &#x62A;&#x641;&#x648;&#x642;&#x62A; &#x639;&#x644;&#x649; &#x627;&#x644;&#x643;&#x644;&#x628; &#x627;&#x644;&#x623;&#x644;&#x645;&#x627;&#x646;&#x64A; &#x627;&#x644;&#x645;&#x62B;&#x64A;&#x631; &#x644;&#x644;&#x62C;&#x627;&#x630;&#x628;&#x64A;&#x629; &#x628;&#x634;&#x643;&#x644; &#x63A;&#x64A;&#x631; &#x639;&#x642;&#x644;&#x627;&#x646;&#x64A;.&lt;/p&gt;
                &lt;blockquote class=&quot;blockquote&quot;&gt;
                    &#x64A;&#x639;&#x62A;&#x645;&#x62F; &#x62A;&#x642;&#x62F;&#x645; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x639;&#x644;&#x649; &#x62C;&#x639;&#x644;&#x647;&#x627; &#x645;&#x644;&#x627;&#x626;&#x645;&#x629; &#x628;&#x62D;&#x64A;&#x62B; &#x644;&#x627; &#x62A;&#x644;&#x627;&#x62D;&#x638;&#x647;&#x627; &#x62D;&#x642;&#x64B;&#x627; &#x60C; &#x644;&#x630;&#x627; &#x641;&#x647;&#x64A; &#x62C;&#x632;&#x621; &#x645;&#x646; &#x627;&#x644;&#x62D;&#x64A;&#x627;&#x629; &#x627;&#x644;&#x64A;&#x648;&#x645;&#x64A;&#x629;.&lt;br&gt;&#x62C;&#x648;&#x646;&#x633;&#x648;&#x646;&lt;/blockquote&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image10.jpg",
            "post_hits" => 5,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:04",
            "updated_at" => "2022-06-12 00:00:04"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'تقنية'),
            $this->getTagIdByLanguageCode('ar', 'جمال'),
            $this->getTagIdByLanguageCode('ar', 'موضة'),
            $this->getTagIdByLanguageCode('ar', 'أسلوب الحياة')
        ]);
        $post->translations()->sync([4]);

        # Post Translation Relations 13, 14, 15

        Translation::create([
            'id' => 5,
            'value' => json_encode([
                'en' => 13,
                'id' => 14,
                'ar' => 15,
            ])
        ]);

        # 13

        $post = Post::create([
            "id" => 13,
            "post_title" => "Travel And Transportation During The Coronavirus Pandemic",
            "post_name" => "travel-and-transportation-during-the-coronavirus-pandemic",
            "post_content" => html_entity_decode("&lt;p&gt;Strech lining hemline above knee burgundy glossy silk complete hid zip little catches rayon. Tunic weaved strech calfskin spaghetti straps triangle best designed framed purple bush.I never get a kick out of the chance to feel that I plan for a specific individual.&lt;/p&gt;&lt;p&gt;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove. A collection of textile samples lay spread out on the table &ndash; Samsa was a travelling salesman &ndash; and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.&lt;/p&gt;&lt;p&gt;You always pass failure on the way&lt;/p&gt;&lt;p&gt;It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;YOUR POSITIVE ACTION COMBINED WITH POSITIVE THINKING RESULTS IN SUCCESS.&lt;/blockquote&gt;&lt;p&gt;Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&lt;/p&gt;&lt;p&gt;On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &ldquo;and&rdquo; and the Little Blind Text should turn around and return to its own, safe country.&lt;/p&gt;&lt;h3&gt;Welcome to the New Normal?&lt;/h3&gt;&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.&lt;/p&gt;&lt;p&gt;Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. &ldquo;How about if I sleep a little bit longer and forget all this nonsense&rdquo;, he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn&rsquo;t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.&lt;/p&gt;&lt;p&gt;Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image13.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:04",
            "updated_at" => "2022-06-12 00:00:04"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Couple'),
            $this->getTagIdByLanguageCode('en', 'Romantic')
        ]);
        $post->translations()->attach(5);

        # 14

        $post = Post::create([
            "id" => 14,
            "post_title" => "Perjalanan Dan Transportasi Selama Pandemi Coronavirus",
            "post_name" => "perjalanan-dan-transportasi-selama-pandemi-coronavirus",
            "post_content" => html_entity_decode("&lt;p&gt;Strech lining hemline di atas lutut burgundy silk glossy complete hid zip little catch rayon. Tunik tenun strech kulit anak sapi spaghetti straps segitiga terbaik dirancang berbingkai ungu bush.Saya tidak pernah mendapatkan kesempatan untuk merasa bahwa saya berencana untuk individu tertentu.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Ketika dia mencapai bukit pertama Pegunungan Italic, dia memiliki pemandangan terakhir di cakrawala kota asalnya Bookmarksgrove. Kumpulan sampel tekstil terhampar di atas meja &ndash; Samsa adalah seorang penjual keliling &ndash; dan di atasnya tergantung sebuah gambar yang baru saja ia potong dari majalah bergambar dan disimpan dalam bingkai bagus berlapis emas.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Anda selalu melewati kegagalan di jalan&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Itu menunjukkan seorang wanita yang mengenakan topi bulu dan boa bulu yang duduk tegak, mengangkat sarung bulu tebal yang menutupi seluruh lengan bawahnya ke arah penonton.&lt;/span&gt;&lt;/p&gt;&lt;blockquote class=&quot;blockquote&quot;&gt;TINDAKAN POSITIF ANDA DIGABUNGKAN DENGAN POSITIF BERPIKIR MENGHASILKAN SUKSES.&lt;/blockquote&gt;&lt;p&gt;Terpisah mereka tinggal di Bookmarksgrove tepat di pantai Semantik, lautan bahasa yang besar. Sebuah sungai kecil bernama Duden mengalir melalui tempat mereka dan memasoknya dengan regelialia yang diperlukan. Ini adalah negara surgawi, di mana bagian-bagian kalimat yang dipanggang terbang ke mulut Anda.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dalam perjalanannya dia bertemu dengan salinan. Salinan itu memperingatkan Teks Buta Kecil, bahwa dari mana asalnya akan ditulis ulang seribu kali dan semua yang tersisa dari asalnya adalah kata &quot;dan&quot; dan Teks Buta Kecil harus berbalik dan kembali ke asalnya, negara yang aman.&lt;/span&gt;&lt;/p&gt;&lt;h3&gt;Selamat datang di New Normal?&lt;/h3&gt;&lt;p&gt;Jauh jauh, di balik kata pegunungan, jauh dari negara Vokalia dan Consonantia, hiduplah teks-teks buta. Terpisah mereka tinggal di Bookmarksgrove tepat di pantai Semantik, lautan bahasa yang besar. Sebuah sungai kecil bernama Duden mengalir melalui tempat mereka dan memasoknya dengan regelialia yang diperlukan.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Gregor kemudian berbalik untuk melihat ke luar jendela pada cuaca yang membosankan. Tetesan hujan bisa terdengar menghantam kaca, yang membuatnya merasa sangat sedih. &ldquo;Bagaimana jika aku tidur sedikit lebih lama dan melupakan semua omong kosong ini&rdquo;, pikirnya, tetapi itu adalah sesuatu yang tidak dapat dia lakukan karena dia terbiasa tidur di sebelah kanannya, dan dalam keadaannya yang sekarang tidak bisa masuk ke dalamnya. posisi. Betapapun kerasnya dia melemparkan dirinya ke kanan, dia selalu berguling kembali ke tempat dia berada.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Ketenangan yang luar biasa telah menguasai seluruh jiwaku, seperti pagi musim semi yang manis ini yang aku nikmati dengan sepenuh hatiku. Saya sendirian, dan merasakan pesona keberadaan di tempat ini, yang diciptakan untuk kebahagiaan jiwa-jiwa seperti saya. Saya sangat bahagia, sahabatku, begitu tenggelam dalam perasaan indah dari keberadaan yang tenang, sehingga saya mengabaikan bakat saya.&lt;/span&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image13.jpg",
            "created_at" => "2022-06-12 00:00:04",
            "updated_at" => "2022-06-12 00:00:04"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Bisnis'),
            $this->getTagIdByLanguageCode('id', 'Pasangan'),
            $this->getTagIdByLanguageCode('id', 'Romantis')
        ]);
        $post->translations()->attach(5);

        # 15

        $post = Post::create([
            "id" => 15,
            "post_title" => "السفر والمواصلات أثناء جائحة فيروس كورونا",
            "post_name" => "lsfr-o-lmo-sl-t-athn-g-h-fyros-koron",
            "post_content" => html_entity_decode("&lt;p&gt; &#x62D;&#x627;&#x634;&#x64A;&#x629; &#x628;&#x637;&#x627;&#x646;&#x629; &#x645;&#x646; Strech &#x641;&#x648;&#x642; &#x627;&#x644;&#x631;&#x643;&#x628;&#x629; &#x62D;&#x631;&#x64A;&#x631; &#x628;&#x648;&#x631;&#x62C;&#x648;&#x646;&#x62F;&#x64A; &#x644;&#x627;&#x645;&#x639; &#x643;&#x627;&#x645;&#x644; &#x633;&#x62D;&#x627;&#x628; &#x62E;&#x641;&#x64A; &#x64A;&#x645;&#x633;&#x643; &#x627;&#x644;&#x642;&#x644;&#x64A;&#x644; &#x645;&#x646; &#x627;&#x644;&#x62D;&#x631;&#x64A;&#x631; &#x627;&#x644;&#x635;&#x646;&#x627;&#x639;&#x64A;. &#x62A;&#x648;&#x646;&#x64A;&#x643; &#x645;&#x646;&#x633;&#x648;&#x62C; &#x645;&#x646; &#x62C;&#x644;&#x62F; &#x627;&#x644;&#x639;&#x62C;&#x644; &#x60C; &#x623;&#x62D;&#x632;&#x645;&#x629; &#x633;&#x628;&#x627;&#x63A;&#x64A;&#x62A;&#x64A; &#x645;&#x62B;&#x644;&#x62B;&#x629; &#x645;&#x635;&#x645;&#x645;&#x629; &#x628;&#x634;&#x643;&#x644; &#x623;&#x641;&#x636;&#x644; &#x634;&#x62C;&#x64A;&#x631;&#x629; &#x623;&#x631;&#x62C;&#x648;&#x627;&#x646;&#x64A;&#x629; &#x645;&#x624;&#x637;&#x631;&#x629;. &lt;/p&gt;
                &lt;p&gt; &#x639;&#x646;&#x62F;&#x645;&#x627; &#x648;&#x635;&#x644;&#x62A; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62A;&#x644;&#x627;&#x644; &#x627;&#x644;&#x623;&#x648;&#x644;&#x649; &#x644;&#x644;&#x62C;&#x628;&#x627;&#x644; &#x627;&#x644;&#x625;&#x64A;&#x637;&#x627;&#x644;&#x64A;&#x629; &#x60C; &#x643;&#x627;&#x646; &#x644;&#x62F;&#x64A;&#x647;&#x627; &#x645;&#x646;&#x638;&#x631; &#x623;&#x62E;&#x64A;&#x631; &#x639;&#x644;&#x649; &#x623;&#x641;&#x642; &#x645;&#x633;&#x642;&#x637; &#x631;&#x623;&#x633;&#x647;&#x627; Bookmarksgrove. &#x627;&#x646;&#x62A;&#x634;&#x631;&#x62A; &#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x645;&#x646; &#x639;&#x64A;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x646;&#x633;&#x64A;&#x62C; &#x639;&#x644;&#x649; &#x627;&#x644;&#x637;&#x627;&#x648;&#x644;&#x629; - &#x643;&#x627;&#x646; &#x633;&#x627;&#x645;&#x633;&#x627; &#x628;&#x627;&#x626;&#x639;&#x64B;&#x627; &#x645;&#x62A;&#x62C;&#x648;&#x644;&#x64B;&#x627; - &#x648;&#x641;&#x648;&#x642;&#x647;&#x627; &#x639;&#x644;&#x642; &#x635;&#x648;&#x631;&#x629; &#x643;&#x627;&#x646; &#x642;&#x62F; &#x642;&#x637;&#x639;&#x647;&#x627; &#x645;&#x624;&#x62E;&#x631;&#x64B;&#x627; &#x645;&#x646; &#x645;&#x62C;&#x644;&#x629; &#x645;&#x635;&#x648;&#x631;&#x629; &#x648;&#x648;&#x636;&#x639;&#x647;&#x627; &#x641;&#x64A; &#x625;&#x637;&#x627;&#x631; &#x645;&#x630;&#x647;&#x644; &#x62C;&#x645;&#x64A;&#x644;. &lt;/p&gt;
                &lt;p&gt; &#x62A;&#x645;&#x631; &#x62F;&#x627;&#x626;&#x645;&#x64B;&#x627; &#x628;&#x627;&#x644;&#x641;&#x634;&#x644; &#x641;&#x64A; &#x637;&#x631;&#x64A;&#x642;&#x643; &lt;/p&gt;
                &lt;p&gt; &#x64A;&#x638;&#x647;&#x631; &#x641;&#x64A; &#x627;&#x644;&#x635;&#x648;&#x631;&#x629; &#x633;&#x64A;&#x62F;&#x629; &#x62A;&#x631;&#x62A;&#x62F;&#x64A; &#x642;&#x628;&#x639;&#x629; &#x645;&#x646; &#x627;&#x644;&#x641;&#x631;&#x648; &#x648;&#x623;&#x641;&#x639;&#x649; &#x645;&#x646; &#x627;&#x644;&#x641;&#x631;&#x648; &#x62C;&#x644;&#x633;&#x62A; &#x645;&#x646;&#x62A;&#x635;&#x628;&#x629; &#x60C; &#x648;&#x647;&#x64A; &#x62A;&#x631;&#x641;&#x639; &#x63A;&#x637;&#x627;&#x621;&#x64B; &#x62B;&#x642;&#x64A;&#x644;&#x64B;&#x627; &#x645;&#x646; &#x627;&#x644;&#x641;&#x631;&#x648; &#x64A;&#x63A;&#x637;&#x64A; &#x643;&#x627;&#x645;&#x644; &#x630;&#x631;&#x627;&#x639;&#x647;&#x627; &#x62A;&#x62C;&#x627;&#x647; &#x627;&#x644;&#x645;&#x634;&#x627;&#x647;&#x62F;. &lt;/p&gt;
                &lt;blockquote class=&quot;blockquote&quot;&gt;
                    &#x64A;&#x62A;&#x631;&#x627;&#x641;&#x642; &#x639;&#x645;&#x644;&#x643; &#x627;&#x644;&#x625;&#x64A;&#x62C;&#x627;&#x628;&#x64A; &#x645;&#x639; &#x646;&#x62A;&#x627;&#x626;&#x62C; &#x627;&#x644;&#x62A;&#x641;&#x643;&#x64A;&#x631; &#x627;&#x644;&#x625;&#x64A;&#x62C;&#x627;&#x628;&#x64A; &#x641;&#x64A; &#x627;&#x644;&#x646;&#x62C;&#x627;&#x62D;.&lt;/blockquote&gt;
                &lt;p&gt; &#x645;&#x646;&#x641;&#x635;&#x644;&#x648;&#x646; &#x64A;&#x639;&#x64A;&#x634;&#x648;&#x646; &#x641;&#x64A; Bookmarksgrove &#x645;&#x628;&#x627;&#x634;&#x631;&#x629; &#x639;&#x644;&#x649; &#x633;&#x627;&#x62D;&#x644; Semantics &#x60C; &#x648;&#x647;&#x648; &#x645;&#x62D;&#x64A;&#x637; &#x644;&#x63A;&#x648;&#x64A; &#x643;&#x628;&#x64A;&#x631;. &#x64A;&#x62A;&#x62F;&#x641;&#x642; &#x646;&#x647;&#x631; &#x635;&#x63A;&#x64A;&#x631; &#x64A;&#x64F;&#x62F;&#x639;&#x649; Duden &#x645;&#x646; &#x645;&#x643;&#x627;&#x646;&#x647; &#x648;&#x64A;&#x645;&#x62F;&#x647;&#x627; &#x628;&#x627;&#x644;&#x631;&#x627;&#x62D;&#x629; &#x627;&#x644;&#x644;&#x627;&#x632;&#x645;&#x629;. &#x625;&#x646;&#x647;&#x627; &#x62F;&#x648;&#x644;&#x629; &#x627;&#x644;&#x641;&#x631;&#x62F;&#x648;&#x633;&#x64A;&#x629; &#x60C; &#x62D;&#x64A;&#x62B; &#x62A;&#x62A;&#x637;&#x627;&#x64A;&#x631; &#x627;&#x644;&#x623;&#x62C;&#x632;&#x627;&#x621; &#x627;&#x644;&#x645;&#x62D;&#x645;&#x635;&#x629; &#x645;&#x646; &#x627;&#x644;&#x62C;&#x645;&#x644; &#x641;&#x64A; &#x641;&#x645;&#x643;. &lt;/p&gt;
                &lt;p&gt; &#x641;&#x64A; &#x637;&#x631;&#x64A;&#x642;&#x647;&#x627; &#x627;&#x644;&#x62A;&#x642;&#x62A; &#x628;&#x646;&#x633;&#x62E;&#x629;. &#x62D;&#x630;&#x631;&#x62A; &#x627;&#x644;&#x646;&#x633;&#x62E;&#x629; &#x627;&#x644;&#x646;&#x635; &#x627;&#x644;&#x645;&#x643;&#x641;&#x648;&#x641; &#x627;&#x644;&#x635;&#x63A;&#x64A;&#x631; &#x60C; &#x645;&#x646; &#x623;&#x646; &#x645;&#x635;&#x62F;&#x631;&#x647; &#x643;&#x627;&#x646; &#x633;&#x64A;&#x64F;&#x639;&#x627;&#x62F; &#x643;&#x62A;&#x627;&#x628;&#x62A;&#x647; &#x623;&#x644;&#x641; &#x645;&#x631;&#x629; &#x648;&#x643;&#x644; &#x645;&#x627; &#x62A;&#x628;&#x642;&#x649; &#x645;&#x646; &#x623;&#x635;&#x644;&#x647; &#x633;&#x64A;&#x643;&#x648;&#x646; &#x643;&#x644;&#x645;&#x629; &quot;&#x648;&quot; &#x648;&#x64A;&#x62C;&#x628; &#x623;&#x646; &#x64A;&#x633;&#x62A;&#x62F;&#x64A;&#x631; &#x627;&#x644;&#x646;&#x635; &#x627;&#x644;&#x635;&#x63A;&#x64A;&#x631; &#x644;&#x644;&#x645;&#x643;&#x641;&#x648;&#x641;&#x64A;&#x646; &#x648;&#x64A;&#x639;&#x648;&#x62F; &#x625;&#x644;&#x649; &#x646;&#x635;&#x647; &#x60C; &#x628;&#x644;&#x62F; &#x622;&#x645;&#x646;. &lt;/p&gt;
                &lt;h3&gt; &#x645;&#x631;&#x62D;&#x628;&#x64B;&#x627; &#x628;&#x643; &#x641;&#x64A; &#x627;&#x644;&#x648;&#x636;&#x639; &#x627;&#x644;&#x639;&#x627;&#x62F;&#x64A; &#x627;&#x644;&#x62C;&#x62F;&#x64A;&#x62F;&#x61F; &lt;/h3&gt;
                &lt;p&gt; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627; &#x60C; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627; &#x60C; &#x62E;&#x644;&#x641; &#x643;&#x644;&#x645;&#x629; &#x627;&#x644;&#x62C;&#x628;&#x627;&#x644; &#x60C; &#x628;&#x639;&#x64A;&#x62F;&#x64B;&#x627; &#x639;&#x646; &#x628;&#x644;&#x627;&#x62F; Vokalia &#x648; Consonantia &#x60C; &#x62A;&#x639;&#x64A;&#x634; &#x627;&#x644;&#x646;&#x635;&#x648;&#x635; &#x627;&#x644;&#x639;&#x645;&#x64A;&#x627;&#x621;. &#x645;&#x646;&#x641;&#x635;&#x644;&#x627;&#x646; &#x64A;&#x639;&#x64A;&#x634;&#x648;&#x646; &#x641;&#x64A; Bookmarksgrove &#x645;&#x628;&#x627;&#x634;&#x631;&#x629; &#x639;&#x644;&#x649; &#x633;&#x627;&#x62D;&#x644; Semantics &#x60C; &#x648;&#x647;&#x648; &#x645;&#x62D;&#x64A;&#x637; &#x644;&#x63A;&#x648;&#x64A; &#x643;&#x628;&#x64A;&#x631;. &#x64A;&#x62A;&#x62F;&#x641;&#x642; &#x646;&#x647;&#x631; &#x635;&#x63A;&#x64A;&#x631; &#x64A;&#x64F;&#x62F;&#x639;&#x649; Duden &#x645;&#x646; &#x645;&#x643;&#x627;&#x646;&#x647; &#x648;&#x64A;&#x645;&#x62F;&#x647; &#x628;&#x627;&#x644;&#x631;&#x627;&#x62D;&#x629; &#x627;&#x644;&#x644;&#x627;&#x632;&#x645;&#x629;. &lt;/p&gt;
                &lt;p&gt;&#x62B;&#x645; &#x627;&#x644;&#x62A;&#x641;&#x62A; &#x62C;&#x631;&#x64A;&#x62C;&#x648;&#x631; &#x644;&#x64A;&#x646;&#x638;&#x631; &#x645;&#x646; &#x627;&#x644;&#x646;&#x627;&#x641;&#x630;&#x629; &#x625;&#x644;&#x649; &#x627;&#x644;&#x637;&#x642;&#x633; &#x627;&#x644;&#x628;&#x627;&#x647;&#x62A;. &#x643;&#x627;&#x646; &#x645;&#x646; &#x627;&#x644;&#x645;&#x645;&#x643;&#x646; &#x633;&#x645;&#x627;&#x639; &#x642;&#x637;&#x631;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x637;&#x631; &#x648;&#x647;&#x64A; &#x62A;&#x636;&#x631;&#x628; &#x627;&#x644;&#x646;&#x627;&#x641;&#x630;&#x629; &#x60C; &#x645;&#x645;&#x627; &#x62C;&#x639;&#x644;&#x647; &#x64A;&#x634;&#x639;&#x631; &#x628;&#x627;&#x644;&#x62D;&#x632;&#x646; &#x627;&#x644;&#x634;&#x62F;&#x64A;&#x62F;. &quot;&#x645;&#x627;&#x630;&#x627; &#x644;&#x648; &#x623;&#x646;&#x627;&#x645; &#x644;&#x641;&#x62A;&#x631;&#x629; &#x623;&#x637;&#x648;&#x644; &#x642;&#x644;&#x64A;&#x644;&#x627;&#x64B; &#x648;&#x646;&#x633;&#x64A;&#x62A; &#x643;&#x644; &#x647;&#x630;&#x627; &#x627;&#x644;&#x647;&#x631;&#x627;&#x621;&quot; &#x60C; &#x647;&#x643;&#x630;&#x627; &#x641;&#x643;&#x631; &#x60C; &#x644;&#x643;&#x646;&#x647; &#x643;&#x627;&#x646; &#x634;&#x64A;&#x626;&#x64B;&#x627; &#x644;&#x645; &#x64A;&#x643;&#x646; &#x642;&#x627;&#x62F;&#x631;&#x64B;&#x627; &#x639;&#x644;&#x649; &#x641;&#x639;&#x644;&#x647; &#x644;&#x623;&#x646;&#x647; &#x627;&#x639;&#x62A;&#x627;&#x62F; &#x627;&#x644;&#x646;&#x648;&#x645; &#x639;&#x644;&#x649; &#x64A;&#x645;&#x64A;&#x646;&#x647; &#x60C; &#x648;&#x641;&#x64A; &#x62D;&#x627;&#x644;&#x62A;&#x647; &#x627;&#x644;&#x62D;&#x627;&#x644;&#x64A;&#x629; &#x644;&#x627; &#x64A;&#x645;&#x643;&#x646;&#x647; &#x627;&#x644;&#x62F;&#x62E;&#x648;&#x644; &#x641;&#x64A; &#x630;&#x644;&#x643; &#x648;&#x636;&#x639;. &#x645;&#x647;&#x645;&#x627; &#x623;&#x644;&#x642;&#x649; &#x628;&#x646;&#x641;&#x633;&#x647; &#x639;&#x644;&#x649; &#x64A;&#x645;&#x64A;&#x646;&#x647; &#x60C; &#x643;&#x627;&#x646; &#x64A;&#x62A;&#x631;&#x627;&#x62C;&#x639; &#x62F;&#x627;&#x626;&#x645;&#x64B;&#x627; &#x625;&#x644;&#x649; &#x62D;&#x64A;&#x62B; &#x643;&#x627;&#x646;.&lt;/p&gt;
                &lt;p&gt;&#x627;&#x633;&#x62A;&#x62D;&#x648;&#x630; &#x627;&#x644;&#x635;&#x641;&#x627;&#x621; &#x627;&#x644;&#x631;&#x627;&#x626;&#x639; &#x639;&#x644;&#x649; &#x631;&#x648;&#x62D;&#x64A; &#x628;&#x627;&#x644;&#x643;&#x627;&#x645;&#x644; &#x60C; &#x645;&#x62B;&#x644; &#x635;&#x628;&#x627;&#x62D; &#x627;&#x644;&#x631;&#x628;&#x64A;&#x639; &#x627;&#x644;&#x62D;&#x644;&#x648; &#x627;&#x644;&#x630;&#x64A; &#x623;&#x633;&#x62A;&#x645;&#x62A;&#x639; &#x628;&#x647; &#x645;&#x646; &#x643;&#x644; &#x642;&#x644;&#x628;&#x64A;. &#x623;&#x646;&#x627; &#x648;&#x62D;&#x64A;&#x62F; &#x60C; &#x648;&#x623;&#x634;&#x639;&#x631; &#x628;&#x633;&#x62D;&#x631; &#x627;&#x644;&#x648;&#x62C;&#x648;&#x62F; &#x641;&#x64A; &#x647;&#x630;&#x647; &#x627;&#x644;&#x628;&#x642;&#x639;&#x629; &#x60C; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x645; &#x625;&#x646;&#x634;&#x627;&#x624;&#x647;&#x627; &#x644;&#x646;&#x639;&#x645;&#x629; &#x623;&#x631;&#x648;&#x627;&#x62D; &#x645;&#x62B;&#x644; &#x646;&#x641;&#x633;&#x64A;. &#x623;&#x646;&#x627; &#x633;&#x639;&#x64A;&#x62F; &#x62C;&#x62F;&#x64B;&#x627; &#x60C; &#x64A;&#x627; &#x635;&#x62F;&#x64A;&#x642;&#x64A; &#x627;&#x644;&#x639;&#x632;&#x64A;&#x632; &#x60C; &#x645;&#x646;&#x63A;&#x645;&#x633; &#x62C;&#x62F;&#x64B;&#x627; &#x641;&#x64A; &#x627;&#x644;&#x625;&#x62D;&#x633;&#x627;&#x633; &#x627;&#x644;&#x631;&#x627;&#x626;&#x639; &#x628;&#x627;&#x644;&#x648;&#x62C;&#x648;&#x62F; &#x627;&#x644;&#x647;&#x627;&#x62F;&#x626; &#x627;&#x644;&#x645;&#x62D;&#x636; &#x60C; &#x644;&#x62F;&#x631;&#x62C;&#x629; &#x623;&#x646;&#x646;&#x64A; &#x623;&#x647;&#x645;&#x644; &#x645;&#x648;&#x627;&#x647;&#x628;&#x64A;.&lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image13.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:05",
            "updated_at" => "2022-06-12 00:00:05"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'اعمال'),
            $this->getTagIdByLanguageCode('ar', 'زوج'),
            $this->getTagIdByLanguageCode('ar', 'رومانسي')
        ]);
        $post->translations()->sync([5]);

        # Post Translation Relations 6, 20, 30

        Translation::create([
            'id' => 6,
            'value' => json_encode([
                'en' => 16,
                'id' => 17,
                'ar' => 18,
            ])
        ]);

        # 16

        $post = Post::create([
            "id" => 16,
            "post_title" => "Refurbished Devices Marketplace Reebelo Bags Seed Funding",
            "post_name" => "refurbished-devices-marketplace-reebelo-bags-seed-funding",
            "post_content" => html_entity_decode("&lt;p&gt;Reebelo, a marketplace for pre-loved devices, has raised an undisclosed amount of seed funding in a round led by Germany-based June Fund.&lt;/p&gt;&lt;p&gt;Early-stage VC firm Antler also participated in the round, according to a statement. Singapore-based Reebelo was part of Antler&rsquo;s third cohort of startups and was a graduate of HyperSpark, StartupX&rsquo;s sustainability pre-accelerator run in partnership with investment giant Temasek.&lt;/p&gt;&lt;p&gt;According to a 2018 study by the National Environment Agency of Singapore, the city-state produces 60,000 tons of e-waste annually, and only 6% of that gets recycled. To help reduce that number, Reebelo&rsquo;s recommerce marketplace enables consumers in Singapore to buy or sell used smartphones, tablets, and notebooks.&lt;/p&gt;&lt;p&gt;Recommerce, or reverse commerce, refers to the buying and selling of pre-owned goods, mainly electronic devices.&lt;/p&gt;&lt;p&gt;How is the startup different? Some recommerce players in Asia include Moby and Red White Mobile in Singapore, Budli in India, and Laku6 in Indonesia.&lt;/p&gt;&lt;p&gt;At its core, Reebelo is a company that buys used electronics from enterprises and individuals and then refurbishes and tests the devices before listing them on the website. The registered secondhand goods dealer also offers extended warranties to give customers peace of mind.&lt;/p&gt;&lt;p&gt;Under its partnership with environmental charity One Tree Planted, the startup said that one tree is planted for every device sold on its platform.&lt;/p&gt;&lt;p&gt;What are its challenges? So far, most people upgrade their devices once newer models are released, a spokesperson for the company told Tech in Asia. Nowadays, broken devices are also thrown away rather than repaired.&lt;/p&gt;&lt;p&gt;The company aims to change this behavior by allowing customers to sell their used devices for cash, giving their older gadgets a new lease on life.&lt;/p&gt;&lt;p&gt;&ldquo;Reebelo&rsquo;s ambitious vision is to build the circular economy for electronics,&rdquo; Philip Franta, founder and CEO at Reebelo, said. &ldquo;[We&rsquo;re trying] to change the way people consume tech devices at a more sustainable pace &ndash; one device at a time.&rdquo;&lt;/p&gt;&lt;p&gt;What&rsquo;s the opportunity? Reebelo&rsquo;s addressable market size in the region, according to the company, stands at US$4.2 billion. To capture a larger share of this, the startup aims to expand into new business lines such as device rentals and offer bundled business phones and laptops for companies.&lt;/p&gt;&lt;p&gt;It also plans to enter other markets across Asia Pacific and add support for more electronics categories in the future.&lt;/p&gt;&lt;p&gt;How much traction has it gotten? The startup claims to have served more than 210,000 users on its platform since January and is &ldquo;aiming to keep growing in a sustainable way month on month.&rdquo;&lt;/p&gt;&lt;p&gt;Who are the team members? The startup was founded just last year by Franta and Rastouil Fabien.&lt;/p&gt;&lt;p&gt;Franta previously served as chief business development officer for German healthtech firm Media4Care, while chief product officer Fabien served as an innovation consultant in France.&lt;/p&gt;"),
            "post_author" => 2,
            "post_type" => "post",
            "post_language" => 1,
            "post_image" => "image16.jpg",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:05",
            "updated_at" => "2022-06-12 00:00:05"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Explore Bali')
        ]);
        $post->translations()->attach(6);

        # 17

        $post = Post::create([
            "id" => 17,
            "post_title" => "Perangkat Refurbished Marketplace Reebelo Bags Pendanaan Benih",
            "post_name" => "perangkat-refurbished-marketplace-reebelo-bags-pendanaan-benih",
            "post_content" => html_entity_decode("&lt;p&gt;Reebelo, pasar untuk perangkat pre-loved, telah mengumpulkan dana awal dalam jumlah yang tidak diungkapkan dalam putaran yang dipimpin oleh June Fund yang berbasis di Jerman.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Perusahaan VC tahap awal Antler juga berpartisipasi dalam putaran tersebut, menurut sebuah pernyataan. Reebelo yang berbasis di Singapura adalah bagian dari kelompok startup ketiga Antler dan merupakan lulusan HyperSpark, pra-akselerator keberlanjutan StartupX yang dijalankan dalam kemitraan dengan raksasa investasi Temasek.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Menurut sebuah studi tahun 2018 oleh Badan Lingkungan Nasional Singapura, negara kota itu menghasilkan 60.000 ton sampah elektronik setiap tahun, dan hanya 6% dari yang didaur ulang. Untuk membantu mengurangi jumlah tersebut, pasar recommerce Reebelo memungkinkan konsumen di Singapura untuk membeli atau menjual smartphone, tablet, dan notebook bekas.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Re-commerce, atau reverse commerce, mengacu pada pembelian dan penjualan barang bekas, terutama perangkat elektronik.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Apa bedanya dengan startup? Beberapa pemain recommerce di Asia antara lain Moby dan Red White Mobile di Singapura, Budli di India, dan Laku6 di Indonesia.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pada intinya, Reebelo adalah perusahaan yang membeli barang elektronik bekas dari perusahaan dan individu, kemudian memperbarui dan menguji perangkat sebelum mencantumkannya di situs web. Dealer barang bekas yang terdaftar juga menawarkan perpanjangan garansi untuk memberikan ketenangan pikiran kepada pelanggan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Di bawah kemitraannya dengan badan amal lingkungan One Tree Planted, startup tersebut mengatakan bahwa satu pohon ditanam untuk setiap perangkat yang dijual di platformnya.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;Apa saja tantangannya? Sejauh ini, kebanyakan orang mengupgrade perangkat mereka begitu model yang lebih baru dirilis, juru bicara perusahaan mengatakan kepada Tech in Asia. Saat ini, perangkat yang rusak juga dibuang daripada diperbaiki.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Perusahaan bertujuan untuk mengubah perilaku ini dengan mengizinkan pelanggan untuk menjual perangkat bekas mereka secara tunai, memberikan gadget lama mereka kesempatan hidup baru.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&ldquo;Visi ambisius Reebelo adalah membangun ekonomi sirkular untuk elektronik,&rdquo; kata Philip Franta, pendiri dan CEO di Reebelo. &ldquo;[Kami mencoba] untuk mengubah cara orang mengonsumsi perangkat teknologi dengan kecepatan yang lebih berkelanjutan &ndash; satu perangkat pada satu waktu.&rdquo;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Apa peluangnya? Ukuran pasar Reebelo yang dapat dialamatkan di wilayah tersebut, menurut perusahaan, mencapai US$4,2 miliar. Untuk menangkap bagian yang lebih besar dari ini, startup bertujuan untuk memperluas ke lini bisnis baru seperti penyewaan perangkat dan menawarkan telepon bisnis dan laptop yang dibundel untuk perusahaan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Ia juga berencana untuk memasuki pasar lain di Asia Pasifik dan menambahkan dukungan untuk lebih banyak kategori elektronik di masa depan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Berapa banyak traksi yang didapatnya? Startup ini mengklaim telah melayani lebih dari 210.000 pengguna di platformnya sejak Januari dan &ldquo;bertujuan untuk terus tumbuh secara berkelanjutan dari bulan ke bulan.&rdquo;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Siapa saja anggota tim? Startup ini didirikan tahun lalu oleh Franta dan Rastouil Fabien.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Franta sebelumnya menjabat sebagai chief business development officer untuk perusahaan teknologi kesehatan Jerman Media4Care, sementara chief product officer Fabien menjabat sebagai konsultan inovasi di Prancis.&lt;/span&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_type" => "post",
            "post_language" => 2,
            "post_image" => "image16.jpg",
            "post_hits" => 1,
            "like" => 1,
            "created_at" => "2022-06-12 00:00:05",
            "updated_at" => "2022-06-12 00:00:05"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Berita'),
            $this->getTagIdByLanguageCode('id', 'Jelajahi Bali')
        ]);
        $post->translations()->attach(6);

        # 18

        $post = Post::create([
            "id" => 18,
            "post_title" => "الأجهزة التي تم تجديدها سوق ريبيلو أكياس تمويل البذور",
            "post_name" => "laghz-lty-tm-tgdydh-sok-rybylo-aky-s-tmoyl-lbthor",
            "post_content" => html_entity_decode("&lt;p&gt;&#x642;&#x627;&#x645;&#x62A; &#x634;&#x631;&#x643;&#x629; Reebelo &#x60C; &#x648;&#x647;&#x64A; &#x633;&#x648;&#x642; &#x644;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x645;&#x62D;&#x628;&#x648;&#x628;&#x629; &#x645;&#x633;&#x628;&#x642;&#x64B;&#x627; &#x60C; &#x628;&#x62C;&#x645;&#x639; &#x645;&#x628;&#x644;&#x63A; &#x644;&#x645; &#x64A;&#x643;&#x634;&#x641; &#x639;&#x646;&#x647; &#x645;&#x646; &#x627;&#x644;&#x62A;&#x645;&#x648;&#x64A;&#x644; &#x627;&#x644;&#x623;&#x648;&#x644;&#x64A; &#x641;&#x64A; &#x62C;&#x648;&#x644;&#x629; &#x628;&#x642;&#x64A;&#x627;&#x62F;&#x629; &#x635;&#x646;&#x62F;&#x648;&#x642; &#x64A;&#x648;&#x646;&#x64A;&#x648; &#x641;&#x64A; &#x623;&#x644;&#x645;&#x627;&#x646;&#x64A;&#x627;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x628;&#x62D;&#x633;&#x628; &#x628;&#x64A;&#x627;&#x646; &#x60C; &#x634;&#x627;&#x631;&#x643;&#x62A; &#x634;&#x631;&#x643;&#x629; Antler &#x641;&#x64A; &#x645;&#x631;&#x62D;&#x644;&#x629; &#x645;&#x628;&#x643;&#x631;&#x629; &#x645;&#x646; &#x631;&#x623;&#x633; &#x627;&#x644;&#x645;&#x627;&#x644; &#x627;&#x644;&#x645;&#x63A;&#x627;&#x645;&#x631; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x641;&#x64A; &#x627;&#x644;&#x62C;&#x648;&#x644;&#x629;. &#x643;&#x627;&#x646;&#x62A; &#x634;&#x631;&#x643;&#x629; Reebelo &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x62A;&#x62E;&#x630; &#x645;&#x646; &#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x645;&#x642;&#x631;&#x627;&#x64B; &#x644;&#x647;&#x627; &#x62C;&#x632;&#x621;&#x64B;&#x627; &#x645;&#x646; &#x627;&#x644;&#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x627;&#x644;&#x62B;&#x627;&#x644;&#x62B;&#x629; &#x645;&#x646; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x644;&#x634;&#x631;&#x643;&#x629; Antler &#x648;&#x62A;&#x62E;&#x631;&#x62C;&#x62A; &#x645;&#x646; HyperSpark &#x60C; &#x648;&#x647;&#x648; &#x628;&#x631;&#x646;&#x627;&#x645;&#x62C; &#x62A;&#x633;&#x631;&#x64A;&#x639; &#x645;&#x633;&#x628;&#x642; &#x644;&#x644;&#x627;&#x633;&#x62A;&#x62F;&#x627;&#x645;&#x629; &#x645;&#x646; StartupX &#x64A;&#x639;&#x645;&#x644; &#x628;&#x627;&#x644;&#x634;&#x631;&#x627;&#x643;&#x629; &#x645;&#x639; &#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x62B;&#x645;&#x627;&#x631; &#x627;&#x644;&#x639;&#x645;&#x644;&#x627;&#x642;&#x629; Temasek.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x641;&#x642;&#x64B;&#x627; &#x644;&#x62F;&#x631;&#x627;&#x633;&#x629; &#x623;&#x62C;&#x631;&#x62A;&#x647;&#x627; &#x648;&#x643;&#x627;&#x644;&#x629; &#x627;&#x644;&#x628;&#x64A;&#x626;&#x629; &#x627;&#x644;&#x648;&#x637;&#x646;&#x64A;&#x629; &#x641;&#x64A; &#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x639;&#x627;&#x645; 2018 &#x60C; &#x62A;&#x646;&#x62A;&#x62C; &#x627;&#x644;&#x645;&#x62F;&#x64A;&#x646;&#x629; 60 &#x623;&#x644;&#x641; &#x637;&#x646; &#x645;&#x646; &#x627;&#x644;&#x646;&#x641;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A;&#x629; &#x633;&#x646;&#x648;&#x64A;&#x64B;&#x627; &#x60C; &#x648;&#x64A;&#x62A;&#x645; &#x625;&#x639;&#x627;&#x62F;&#x629; &#x62A;&#x62F;&#x648;&#x64A;&#x631; 6&#x66A; &#x641;&#x642;&#x637; &#x645;&#x646;&#x647;&#x627;. &#x644;&#x644;&#x645;&#x633;&#x627;&#x639;&#x62F;&#x629; &#x641;&#x64A; &#x62A;&#x642;&#x644;&#x64A;&#x644; &#x647;&#x630;&#x627; &#x627;&#x644;&#x639;&#x62F;&#x62F; &#x60C; &#x64A;&#x62A;&#x64A;&#x62D; &#x633;&#x648;&#x642; &#x625;&#x639;&#x627;&#x62F;&#x629; &#x627;&#x644;&#x62A;&#x62C;&#x627;&#x631;&#x629; &#x641;&#x64A; Reebelo &#x644;&#x644;&#x645;&#x633;&#x62A;&#x647;&#x644;&#x643;&#x64A;&#x646; &#x641;&#x64A; &#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x634;&#x631;&#x627;&#x621; &#x623;&#x648; &#x628;&#x64A;&#x639; &#x627;&#x644;&#x647;&#x648;&#x627;&#x62A;&#x641; &#x627;&#x644;&#x630;&#x643;&#x64A;&#x629; &#x648;&#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x644;&#x648;&#x62D;&#x64A;&#x629; &#x648;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x643;&#x645;&#x628;&#x64A;&#x648;&#x62A;&#x631; &#x627;&#x644;&#x645;&#x62D;&#x645;&#x648;&#x644;&#x629; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x639;&#x645;&#x644;&#x629;.&lt;/p&gt;
                &lt;p&gt; &#x64A;&#x634;&#x64A;&#x631; &#x645;&#x635;&#x637;&#x644;&#x62D; &#x625;&#x639;&#x627;&#x62F;&#x629; &#x627;&#x644;&#x62A;&#x62C;&#x627;&#x631;&#x629; &#x623;&#x648; &#x627;&#x644;&#x62A;&#x62C;&#x627;&#x631;&#x629; &#x627;&#x644;&#x639;&#x643;&#x633;&#x64A;&#x629; &#x625;&#x644;&#x649; &#x634;&#x631;&#x627;&#x621; &#x648;&#x628;&#x64A;&#x639; &#x627;&#x644;&#x633;&#x644;&#x639; &#x627;&#x644;&#x645;&#x645;&#x644;&#x648;&#x643;&#x629; &#x645;&#x633;&#x628;&#x642;&#x64B;&#x627; &#x60C; &#x648;&#x644;&#x627; &#x633;&#x64A;&#x645;&#x627; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A;&#x629;. &lt;/p&gt;
                &lt;p&gt; &#x643;&#x64A;&#x641; &#x62A;&#x62E;&#x62A;&#x644;&#x641; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629;&#x61F; &#x628;&#x639;&#x636; &#x644;&#x627;&#x639;&#x628;&#x64A; &#x625;&#x639;&#x627;&#x62F;&#x629; &#x627;&#x644;&#x62A;&#x62C;&#x627;&#x631;&#x629; &#x641;&#x64A; &#x622;&#x633;&#x64A;&#x627; &#x64A;&#x634;&#x645;&#x644;&#x648;&#x646; Moby &#x648; Red White Mobile &#x641;&#x64A; &#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x60C; &#x648; Budli &#x641;&#x64A; &#x627;&#x644;&#x647;&#x646;&#x62F; &#x60C; &#x648; Laku6 &#x641;&#x64A; &#x625;&#x646;&#x62F;&#x648;&#x646;&#x64A;&#x633;&#x64A;&#x627;. &lt;/p&gt;
                &lt;p&gt; &#x641;&#x64A; &#x62C;&#x648;&#x647;&#x631;&#x647;&#x627; &#x60C; Reebelo &#x647;&#x64A; &#x634;&#x631;&#x643;&#x629; &#x62A;&#x634;&#x62A;&#x631;&#x64A; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A;&#x629; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x639;&#x645;&#x644;&#x629; &#x645;&#x646; &#x627;&#x644;&#x645;&#x624;&#x633;&#x633;&#x627;&#x62A; &#x648;&#x627;&#x644;&#x623;&#x641;&#x631;&#x627;&#x62F; &#x62B;&#x645; &#x62A;&#x642;&#x648;&#x645; &#x628;&#x62A;&#x62C;&#x62F;&#x64A;&#x62F; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x648;&#x627;&#x62E;&#x62A;&#x628;&#x627;&#x631;&#x647;&#x627; &#x642;&#x628;&#x644; &#x625;&#x62F;&#x631;&#x627;&#x62C;&#x647;&#x627; &#x639;&#x644;&#x649; &#x645;&#x648;&#x642;&#x639; &#x627;&#x644;&#x648;&#x64A;&#x628;. &#x64A;&#x642;&#x62F;&#x645; &#x62A;&#x627;&#x62C;&#x631; &#x627;&#x644;&#x628;&#x636;&#x627;&#x626;&#x639; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x639;&#x645;&#x644;&#x629; &#x627;&#x644;&#x645;&#x633;&#x62C;&#x644; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x636;&#x645;&#x627;&#x646;&#x627;&#x62A; &#x645;&#x645;&#x62A;&#x62F;&#x629; &#x644;&#x645;&#x646;&#x62D; &#x627;&#x644;&#x639;&#x645;&#x644;&#x627;&#x621; &#x631;&#x627;&#x62D;&#x629; &#x627;&#x644;&#x628;&#x627;&#x644;. &lt;/p&gt;
                &lt;p&gt; &#x641;&#x64A; &#x625;&#x637;&#x627;&#x631; &#x634;&#x631;&#x627;&#x643;&#x62A;&#x647;&#x627; &#x645;&#x639; &#x627;&#x644;&#x62C;&#x645;&#x639;&#x64A;&#x629; &#x627;&#x644;&#x62E;&#x64A;&#x631;&#x64A;&#x629; &#x627;&#x644;&#x628;&#x64A;&#x626;&#x64A;&#x629; One Tree Planted &#x60C; &#x642;&#x627;&#x644;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x625;&#x646; &#x634;&#x62C;&#x631;&#x629; &#x648;&#x627;&#x62D;&#x62F;&#x629; &#x62A;&#x64F;&#x632;&#x631;&#x639; &#x645;&#x642;&#x627;&#x628;&#x644; &#x643;&#x644; &#x62C;&#x647;&#x627;&#x632; &#x64A;&#x64F;&#x628;&#x627;&#x639; &#x639;&#x644;&#x649; &#x645;&#x646;&#x635;&#x62A;&#x647;&#x627;. &lt;/p&gt;
                &lt;p&gt; &#x645;&#x627; &#x647;&#x64A; &#x62A;&#x62D;&#x62F;&#x64A;&#x627;&#x62A;&#x647;&#x627;&#x61F; &#x62D;&#x62A;&#x649; &#x627;&#x644;&#x622;&#x646; &#x60C; &#x64A;&#x642;&#x648;&#x645; &#x645;&#x639;&#x638;&#x645; &#x627;&#x644;&#x623;&#x634;&#x62E;&#x627;&#x635; &#x628;&#x62A;&#x631;&#x642;&#x64A;&#x629; &#x623;&#x62C;&#x647;&#x632;&#x62A;&#x647;&#x645; &#x628;&#x645;&#x62C;&#x631;&#x62F; &#x637;&#x631;&#x62D; &#x637;&#x631;&#x632; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x60C; &#x643;&#x645;&#x627; &#x642;&#x627;&#x644; &#x645;&#x62A;&#x62D;&#x62F;&#x62B; &#x628;&#x627;&#x633;&#x645; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x644;&#x640; Tech in Asia. &#x641;&#x64A; &#x627;&#x644;&#x648;&#x642;&#x62A; &#x627;&#x644;&#x62D;&#x627;&#x636;&#x631; &#x60C; &#x64A;&#x62A;&#x645; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x627;&#x644;&#x62A;&#x62E;&#x644;&#x635; &#x645;&#x646; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x645;&#x643;&#x633;&#x648;&#x631;&#x629; &#x628;&#x62F;&#x644;&#x627;&#x64B; &#x645;&#x646; &#x625;&#x635;&#x644;&#x627;&#x62D;&#x647;&#x627;. &lt;/p&gt;
                &lt;p&gt; &#x62A;&#x647;&#x62F;&#x641; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x625;&#x644;&#x649; &#x62A;&#x63A;&#x64A;&#x64A;&#x631; &#x647;&#x630;&#x627; &#x627;&#x644;&#x633;&#x644;&#x648;&#x643; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x627;&#x644;&#x633;&#x645;&#x627;&#x62D; &#x644;&#x644;&#x639;&#x645;&#x644;&#x627;&#x621; &#x628;&#x628;&#x64A;&#x639; &#x623;&#x62C;&#x647;&#x632;&#x62A;&#x647;&#x645; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x639;&#x645;&#x644;&#x629; &#x646;&#x642;&#x62F;&#x64B;&#x627; &#x60C; &#x648;&#x645;&#x646;&#x62D; &#x623;&#x62C;&#x647;&#x632;&#x62A;&#x647;&#x645; &#x627;&#x644;&#x642;&#x62F;&#x64A;&#x645;&#x629; &#x641;&#x631;&#x635;&#x629; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x644;&#x644;&#x62D;&#x64A;&#x627;&#x629;. &lt;/p&gt;
                &lt;p&gt;&#x642;&#x627;&#x644; &#x641;&#x64A;&#x644;&#x64A;&#x628; &#x641;&#x631;&#x627;&#x646;&#x62A;&#x627; &#x60C; &#x627;&#x644;&#x645;&#x624;&#x633;&#x633; &#x648;&#x627;&#x644;&#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x62A;&#x646;&#x641;&#x64A;&#x630;&#x64A; &#x644;&#x634;&#x631;&#x643;&#x629; Reebelo &#x60C; &quot;&#x62A;&#x62A;&#x645;&#x62B;&#x644; &#x631;&#x624;&#x64A;&#x629; Reebelo &#x627;&#x644;&#x637;&#x645;&#x648;&#x62D;&#x629; &#x641;&#x64A; &#x628;&#x646;&#x627;&#x621; &#x627;&#x642;&#x62A;&#x635;&#x627;&#x62F; &#x62F;&#x627;&#x626;&#x631;&#x64A; &#x644;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A;&#x627;&#x62A;&quot;. &quot;[&#x646;&#x62D;&#x627;&#x648;&#x644;] &#x62A;&#x63A;&#x64A;&#x64A;&#x631; &#x627;&#x644;&#x637;&#x631;&#x64A;&#x642;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x64A;&#x633;&#x62A;&#x647;&#x644;&#x643; &#x628;&#x647;&#x627; &#x627;&#x644;&#x623;&#x634;&#x62E;&#x627;&#x635; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x62A;&#x642;&#x646;&#x64A;&#x629; &#x628;&#x648;&#x62A;&#x64A;&#x631;&#x629; &#x623;&#x643;&#x62B;&#x631; &#x627;&#x633;&#x62A;&#x62F;&#x627;&#x645;&#x629; - &#x62C;&#x647;&#x627;&#x632; &#x648;&#x627;&#x62D;&#x62F; &#x641;&#x64A; &#x643;&#x644; &#x645;&#x631;&#x629;.&quot;&lt;/p&gt;
                &lt;p&gt;&#x645;&#x627; &#x647;&#x64A; &#x627;&#x644;&#x641;&#x631;&#x635;&#x629;&#x61F; &#x64A;&#x628;&#x644;&#x63A; &#x62D;&#x62C;&#x645; &#x633;&#x648;&#x642; Reebelo &#x627;&#x644;&#x642;&#x627;&#x628;&#x644; &#x644;&#x644;&#x62A;&#x648;&#x62C;&#x64A;&#x647; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x646;&#x637;&#x642;&#x629; &#x60C; &#x648;&#x641;&#x642;&#x64B;&#x627; &#x644;&#x644;&#x634;&#x631;&#x643;&#x629; &#x60C; 4.2 &#x645;&#x644;&#x64A;&#x627;&#x631; &#x62F;&#x648;&#x644;&#x627;&#x631; &#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A;. &#x648;&#x644;&#x644;&#x62D;&#x635;&#x648;&#x644; &#x639;&#x644;&#x649; &#x62D;&#x635;&#x629; &#x623;&#x643;&#x628;&#x631; &#x645;&#x646; &#x630;&#x644;&#x643; &#x60C; &#x62A;&#x647;&#x62F;&#x641; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62A;&#x648;&#x633;&#x639; &#x641;&#x64A; &#x62E;&#x637;&#x648;&#x637; &#x623;&#x639;&#x645;&#x627;&#x644; &#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x645;&#x62B;&#x644; &#x62A;&#x623;&#x62C;&#x64A;&#x631; &#x627;&#x644;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x648;&#x62A;&#x642;&#x62F;&#x64A;&#x645; &#x647;&#x648;&#x627;&#x62A;&#x641; &#x627;&#x644;&#x623;&#x639;&#x645;&#x627;&#x644; &#x627;&#x644;&#x645;&#x62C;&#x645;&#x639;&#x629; &#x648;&#x623;&#x62C;&#x647;&#x632;&#x629; &#x627;&#x644;&#x643;&#x645;&#x628;&#x64A;&#x648;&#x62A;&#x631; &#x627;&#x644;&#x645;&#x62D;&#x645;&#x648;&#x644;&#x629; &#x644;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A;.&lt;/p&gt;
                &lt;p&gt; &#x62A;&#x62E;&#x637;&#x637; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x644;&#x62F;&#x62E;&#x648;&#x644; &#x623;&#x633;&#x648;&#x627;&#x642; &#x623;&#x62E;&#x631;&#x649; &#x639;&#x628;&#x631; &#x645;&#x646;&#x637;&#x642;&#x629; &#x622;&#x633;&#x64A;&#x627; &#x648;&#x627;&#x644;&#x645;&#x62D;&#x64A;&#x637; &#x627;&#x644;&#x647;&#x627;&#x62F;&#x626; &#x648;&#x625;&#x636;&#x627;&#x641;&#x629; &#x62F;&#x639;&#x645; &#x644;&#x645;&#x632;&#x64A;&#x62F; &#x645;&#x646; &#x641;&#x626;&#x627;&#x62A; &#x627;&#x644;&#x625;&#x644;&#x643;&#x62A;&#x631;&#x648;&#x646;&#x64A;&#x627;&#x62A; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x642;&#x628;&#x644;. &lt;/p&gt;
                &lt;p&gt;&#x645;&#x627; &#x645;&#x642;&#x62F;&#x627;&#x631; &#x627;&#x644;&#x62C;&#x631; &#x627;&#x644;&#x630;&#x64A; &#x62D;&#x635;&#x644;&#x62A; &#x639;&#x644;&#x64A;&#x647;&#x61F; &#x62A;&#x62F;&#x639;&#x64A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x623;&#x646;&#x647;&#x627; &#x642;&#x62F; &#x62E;&#x62F;&#x645;&#x62A; &#x623;&#x643;&#x62B;&#x631; &#x645;&#x646; 210.000 &#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x639;&#x644;&#x649; &#x646;&#x638;&#x627;&#x645;&#x647;&#x627; &#x627;&#x644;&#x623;&#x633;&#x627;&#x633;&#x64A; &#x645;&#x646;&#x630; &#x643;&#x627;&#x646;&#x648;&#x646; &#x627;&#x644;&#x62B;&#x627;&#x646;&#x64A; (&#x64A;&#x646;&#x627;&#x64A;&#x631;) &#x648; &quot;&#x62A;&#x647;&#x62F;&#x641; &#x625;&#x644;&#x649; &#x627;&#x644;&#x627;&#x633;&#x62A;&#x645;&#x631;&#x627;&#x631; &#x641;&#x64A; &#x627;&#x644;&#x646;&#x645;&#x648; &#x628;&#x637;&#x631;&#x64A;&#x642;&#x629; &#x645;&#x633;&#x62A;&#x62F;&#x627;&#x645;&#x629; &#x634;&#x647;&#x631;&#x64B;&#x627; &#x628;&#x639;&#x62F; &#x634;&#x647;&#x631;&quot;.&lt;/p&gt;
                &lt;p&gt; &#x645;&#x646; &#x647;&#x645; &#x623;&#x639;&#x636;&#x627;&#x621; &#x627;&#x644;&#x641;&#x631;&#x64A;&#x642;&#x61F; &#x62A;&#x623;&#x633;&#x633;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x627;&#x644;&#x639;&#x627;&#x645; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A; &#x641;&#x642;&#x637; &#x645;&#x646; &#x642;&#x628;&#x644; &#x641;&#x631;&#x627;&#x646;&#x62A;&#x627; &#x648;&#x631;&#x627;&#x633;&#x62A;&#x648;&#x64A;&#x644; &#x641;&#x627;&#x628;&#x64A;&#x627;&#x646;. &lt;/p&gt;
                &lt;p&gt; &#x639;&#x645;&#x644; &#x641;&#x631;&#x627;&#x646;&#x62A;&#x627; &#x633;&#x627;&#x628;&#x642;&#x64B;&#x627; &#x643;&#x631;&#x626;&#x64A;&#x633; &#x62A;&#x646;&#x641;&#x64A;&#x630;&#x64A; &#x644;&#x62A;&#x637;&#x648;&#x64A;&#x631; &#x627;&#x644;&#x623;&#x639;&#x645;&#x627;&#x644; &#x641;&#x64A; &#x634;&#x631;&#x643;&#x629; Media4Care &#x627;&#x644;&#x623;&#x644;&#x645;&#x627;&#x646;&#x64A;&#x629; &#x644;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x635;&#x62D;&#x64A;&#x629; &#x60C; &#x628;&#x64A;&#x646;&#x645;&#x627; &#x639;&#x645;&#x644; &#x641;&#x627;&#x628;&#x64A;&#x627;&#x646; &#x643;&#x628;&#x64A;&#x631; &#x645;&#x633;&#x624;&#x648;&#x644;&#x64A; &#x627;&#x644;&#x645;&#x646;&#x62A;&#x62C;&#x627;&#x62A; &#x643;&#x645;&#x633;&#x62A;&#x634;&#x627;&#x631; &#x644;&#x644;&#x627;&#x628;&#x62A;&#x643;&#x627;&#x631; &#x641;&#x64A; &#x641;&#x631;&#x646;&#x633;&#x627;. &lt;/p&gt;"),
            "post_author" => 3,
            "post_type" => "post",
            "post_language" => 3,
            "post_image" => "image16.jpg",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:06",
            "updated_at" => "2022-06-12 00:00:06"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'أخبار'),
            $this->getTagIdByLanguageCode('ar', 'اكتشف بالي')
        ]);
        $post->translations()->sync([6]);

        # Post Translation Relations 19, 20, 21

        Translation::create([
            'id' => 7,
            'value' => json_encode([
                'en' => 19,
                'id' => 20,
                'ar' => 21,
            ])
        ]);

        # 19

        $post = Post::create([
            "id" => 19,
            "post_title" => "Singapore Fintech Startup Raises Seed Funding To Digitize Corporate Loans",
            "post_name" => "singapore-fintech-startup-raises-seed-funding-to-digitize-corporate-loans",
            "post_content" => html_entity_decode("&lt;p&gt;Singapore-based iLex, which aims to transform the corporate lending market, announced that it has raised an undisclosed amount of seed funding from strategic investors in France, Hong Kong, Singapore, and the US.&lt;/p&gt;&lt;p&gt;The startup, which was launched just last year, wants to create an end-to-end digital trading platform for primary syndicated loans and secondary loans. To do this, it plans to create a data analytics tool to help participants make informed credit decisions. As transactions increasingly go online, it also aims to automate deal workflows and offer secure online trading and communications.&lt;/p&gt;&lt;p&gt;The market participants it currently supports include banks, private debt funds, pension funds, asset managers, life insurers, hedge funds, and sovereign wealth funds, among others.&lt;/p&gt;&lt;p&gt;The new funds, ILex said, will be used to develop the first version of its platform, which will feature its own AI matching engine, trading protocols, and data analytics tool.&lt;/p&gt;&lt;p&gt;What problem is it solving? While digitization has already occurred for some asset classes like equities and foreign exchanges, the corporate loan market still largely relies on inefficient manual processes, iLex CEO and founder Bertrand Billon said.&lt;/p&gt;&lt;p&gt;According to the company, the pain points in the market are evident: constrained market reach due to limited resources, lack of liquidity in secondary lending, low-level price discovery, limited market data, and compliance and operational risks.&lt;/p&gt;&lt;p&gt;To tackle these issues, the startup&rsquo;s digital solutions will help users access global deals through its AI matching system, the company said in a statement. The firm will also automate trading execution &ndash; through productivity tools and a centralized audit trail &ndash; and will offer real-time data visualization as well as loan pricing and benchmarking mechanisms so users can gain deep market insights.&lt;/p&gt;&lt;p&gt;&ldquo;I believe our difference lies in the technology that is driving our solutions and data offerings and, importantly, our strategic partnerships with industry players,&rdquo; Billon said.&lt;/p&gt;&lt;p&gt;The company has so far formed partnerships with London-based information provider IHS Markit and financial data provider Refinitiv.&lt;/p&gt;&lt;p&gt;What&rsquo;s the opportunity? In Asia Pacific, the primary syndicated loans market was worth around US$700 billon last year, while the secondary loans market was estimated at around US$50 billon, according to iLex.&lt;/p&gt;&lt;p&gt;Over the last five years, there have been 1,200 active lenders and over 12,000 borrowers in the region accessing capital through syndicated transactions.&lt;/p&gt;&lt;p&gt;But while corporate lending drives the overall economy, being the second-largest source of funding for businesses, less than 1% of fintech investments have gone into this sector, the company observed. ILex therefore positions itself as a pioneer in digitizing the industry.&lt;/p&gt;&lt;p&gt;What are its challenges? As with any other digital marketplace, iLex recognizes that it has to work hard to drive the adoption of its platform and increase deal flow and volumes.&lt;/p&gt;&lt;p&gt;To do this, it will focus on attracting and retaining sell-side arrangers and buy-side investors to become a &ldquo;must-have&rdquo; tool for market participants, the company said.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image19.jpg",
            "post_hits" => 4,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:06",
            "updated_at" => "2022-06-12 00:00:06"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Explore Bali'),
            $this->getTagIdByLanguageCode('en', 'Startups')
        ]);
        $post->translations()->attach(7);

        # 20

        $post = Post::create([
            "id" => 20,
            "post_title" => "Startup Fintech Singapura Raih Seed Funding Untuk Mendigitalkan Pinjaman Korporasi",
            "post_name" => "startup-fintech-singapura-raih-seed-funding-untuk-mendigitalkan-pinjaman-korporasi",
            "post_content" => html_entity_decode("&lt;p&gt;iLex yang berbasis di Singapura, yang bertujuan untuk mengubah pasar pinjaman korporasi, mengumumkan bahwa mereka telah mengumpulkan sejumlah dana awal yang tidak diungkapkan dari investor strategis di Prancis, Hong Kong, Singapura, dan AS.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Startup yang baru diluncurkan tahun lalu ini ingin membuat platform trading digital end-to-end untuk pinjaman sindikasi primer dan pinjaman sekunder. Untuk melakukan ini, ia berencana untuk membuat alat analisis data untuk membantu peserta membuat keputusan kredit yang tepat. Karena transaksi semakin online, ini juga bertujuan untuk mengotomatiskan alur kerja kesepakatan dan menawarkan perdagangan dan komunikasi online yang aman.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pelaku pasar saat ini mendukung antara lain bank, dana utang swasta, dana pensiun, manajer aset, asuransi jiwa, dana lindung nilai, dan dana kekayaan negara.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Dana baru, kata Ilex, akan digunakan untuk mengembangkan versi pertama platformnya, yang akan menampilkan mesin pencocokan AI, protokol perdagangan, dan alat analisis datanya sendiri.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Masalah apa yang dipecahkannya? Sementara digitalisasi telah terjadi untuk beberapa kelas aset seperti ekuitas dan valuta asing, pasar pinjaman korporasi sebagian besar masih bergantung pada proses manual yang tidak efisien, kata CEO dan pendiri iLex Bertrand Billon.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Menurut perusahaan, titik-titik sakit di pasar terlihat jelas: jangkauan pasar yang terbatas karena sumber daya yang terbatas, kurangnya likuiditas dalam pinjaman sekunder, penemuan harga tingkat rendah, data pasar yang terbatas, dan risiko kepatuhan dan operasional.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Untuk mengatasi masalah ini, solusi digital startup akan membantu pengguna mengakses kesepakatan global melalui sistem pencocokan AI-nya, kata perusahaan itu dalam sebuah pernyataan. Perusahaan juga akan mengotomatiskan eksekusi perdagangan &ndash; melalui alat produktivitas dan jejak audit terpusat &ndash; dan akan menawarkan visualisasi data waktu nyata serta penetapan harga pinjaman dan mekanisme pembandingan sehingga pengguna dapat memperoleh wawasan pasar yang mendalam.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&ldquo;Saya yakin perbedaan kami terletak pada teknologi yang mendorong solusi dan penawaran data kami, dan yang terpenting, kemitraan strategis kami dengan para pemain industri,&rdquo; kata Billon.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Perusahaan sejauh ini telah menjalin kemitraan dengan penyedia informasi IHS Markit yang berbasis di London dan penyedia data keuangan Refinitiv.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Apa peluangnya? Di Asia Pasifik, pasar pinjaman sindikasi primer bernilai sekitar US$700 miliar tahun lalu, sedangkan pasar pinjaman sekunder diperkirakan sekitar US$50 miliar, menurut iLex.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Selama lima tahun terakhir, ada 1.200 pemberi pinjaman aktif dan lebih dari 12.000 peminjam di wilayah tersebut mengakses modal melalui transaksi sindikasi.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;Tetapi sementara pinjaman korporasi mendorong perekonomian secara keseluruhan, menjadi sumber pendanaan terbesar kedua untuk bisnis, kurang dari 1% investasi fintech telah masuk ke sektor ini, perusahaan mengamati. Oleh karena itu, ILex memposisikan dirinya sebagai pelopor dalam digitalisasi industri.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Apa saja tantangannya? Seperti halnya pasar digital lainnya, iLex menyadari bahwa ia harus bekerja keras untuk mendorong adopsi platformnya dan meningkatkan aliran dan volume kesepakatan.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Untuk melakukan ini, itu akan fokus pada menarik dan mempertahankan arranger sisi jual dan investor sisi beli untuk menjadi alat yang &quot;harus dimiliki&quot; bagi pelaku pasar, kata perusahaan.&lt;/span&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image19.jpg",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:06",
            "updated_at" => "2022-06-12 00:00:06"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Berita'),
            $this->getTagIdByLanguageCode('id', 'Jelajahi Bali'),
            $this->getTagIdByLanguageCode('id', 'Startups')
        ]);
        $post->translations()->attach(7);

        # 21

        $post = Post::create([
            "id" => 21,
            "post_title" => "شركة سنغافورة المالية الناشئة ترفع التمويل الأولي لرقمنة قروض الشركات",
            "post_name" => "shrk-sngh-for-lm-ly-ln-sh-trfaa-ltmoyl-laoly-lrkmn-krod-lshrk-t",
            "post_content" => html_entity_decode("&lt;p&gt;&#x623;&#x639;&#x644;&#x646;&#x62A; &#x634;&#x631;&#x643;&#x629; iLex &#x648;&#x645;&#x642;&#x631;&#x647;&#x627; &#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x60C; &#x648;&#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x647;&#x62F;&#x641; &#x625;&#x644;&#x649; &#x62A;&#x63A;&#x64A;&#x64A;&#x631; &#x633;&#x648;&#x642; &#x625;&#x642;&#x631;&#x627;&#x636; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x60C; &#x623;&#x646;&#x647;&#x627; &#x62C;&#x645;&#x639;&#x62A; &#x645;&#x628;&#x644;&#x63A;&#x64B;&#x627; &#x644;&#x645; &#x64A;&#x643;&#x634;&#x641; &#x639;&#x646;&#x647; &#x645;&#x646; &#x627;&#x644;&#x62A;&#x645;&#x648;&#x64A;&#x644; &#x627;&#x644;&#x623;&#x648;&#x644;&#x64A; &#x645;&#x646; &#x645;&#x633;&#x62A;&#x62B;&#x645;&#x631;&#x64A;&#x646; &#x627;&#x633;&#x62A;&#x631;&#x627;&#x62A;&#x64A;&#x62C;&#x64A;&#x64A;&#x646; &#x641;&#x64A; &#x641;&#x631;&#x646;&#x633;&#x627; &#x648;&#x647;&#x648;&#x646;&#x63A; &#x643;&#x648;&#x646;&#x63A; &#x648;&#x633;&#x646;&#x63A;&#x627;&#x641;&#x648;&#x631;&#x629; &#x648;&#x627;&#x644;&#x648;&#x644;&#x627;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x62F;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x62A;&#x631;&#x64A;&#x62F; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x60C; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x645; &#x625;&#x637;&#x644;&#x627;&#x642;&#x647;&#x627; &#x627;&#x644;&#x639;&#x627;&#x645; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A; &#x641;&#x642;&#x637; &#x60C; &#x625;&#x646;&#x634;&#x627;&#x621; &#x645;&#x646;&#x635;&#x629; &#x62A;&#x62F;&#x627;&#x648;&#x644; &#x631;&#x642;&#x645;&#x64A;&#x629; &#x634;&#x627;&#x645;&#x644;&#x629; &#x644;&#x644;&#x642;&#x631;&#x648;&#x636; &#x627;&#x644;&#x645;&#x634;&#x62A;&#x631;&#x643;&#x629; &#x627;&#x644;&#x623;&#x648;&#x644;&#x64A;&#x629; &#x648;&#x627;&#x644;&#x642;&#x631;&#x648;&#x636; &#x627;&#x644;&#x62B;&#x627;&#x646;&#x648;&#x64A;&#x629;. &#x644;&#x644;&#x642;&#x64A;&#x627;&#x645; &#x628;&#x630;&#x644;&#x643; &#x60C; &#x62A;&#x62E;&#x637;&#x637; &#x644;&#x625;&#x646;&#x634;&#x627;&#x621; &#x623;&#x62F;&#x627;&#x629; &#x644;&#x62A;&#x62D;&#x644;&#x64A;&#x644; &#x627;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x644;&#x645;&#x633;&#x627;&#x639;&#x62F;&#x629; &#x627;&#x644;&#x645;&#x634;&#x627;&#x631;&#x643;&#x64A;&#x646; &#x639;&#x644;&#x649; &#x627;&#x62A;&#x62E;&#x627;&#x630; &#x642;&#x631;&#x627;&#x631;&#x627;&#x62A; &#x627;&#x626;&#x62A;&#x645;&#x627;&#x646;&#x64A;&#x629; &#x645;&#x633;&#x62A;&#x646;&#x64A;&#x631;&#x629;. &#x646;&#x638;&#x631;&#x64B;&#x627; &#x644;&#x623;&#x646; &#x627;&#x644;&#x645;&#x639;&#x627;&#x645;&#x644;&#x627;&#x62A; &#x62A;&#x646;&#x62A;&#x642;&#x644; &#x639;&#x628;&#x631; &#x627;&#x644;&#x625;&#x646;&#x62A;&#x631;&#x646;&#x62A; &#x628;&#x634;&#x643;&#x644; &#x645;&#x62A;&#x632;&#x627;&#x64A;&#x62F; &#x60C; &#x641;&#x625;&#x646;&#x647;&#x627; &#x62A;&#x647;&#x62F;&#x641; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x625;&#x644;&#x649; &#x623;&#x62A;&#x645;&#x62A;&#x629; &#x633;&#x64A;&#x631; &#x639;&#x645;&#x644; &#x627;&#x644;&#x635;&#x641;&#x642;&#x627;&#x62A; &#x648;&#x62A;&#x648;&#x641;&#x64A;&#x631; &#x62A;&#x62F;&#x627;&#x648;&#x644; &#x648;&#x627;&#x62A;&#x635;&#x627;&#x644;&#x627;&#x62A; &#x622;&#x645;&#x646;&#x629; &#x639;&#x628;&#x631; &#x627;&#x644;&#x625;&#x646;&#x62A;&#x631;&#x646;&#x62A;.&lt;/p&gt;
                &lt;p&gt;&#x64A;&#x634;&#x645;&#x644; &#x627;&#x644;&#x645;&#x634;&#x627;&#x631;&#x643;&#x648;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x633;&#x648;&#x642; &#x627;&#x644;&#x630;&#x64A; &#x62A;&#x62F;&#x639;&#x645;&#x647; &#x62D;&#x627;&#x644;&#x64A;&#x64B;&#x627; &#x627;&#x644;&#x628;&#x646;&#x648;&#x643; &#x60C; &#x648;&#x635;&#x646;&#x627;&#x62F;&#x64A;&#x642; &#x627;&#x644;&#x62F;&#x64A;&#x646; &#x627;&#x644;&#x62E;&#x627;&#x635;&#x629; &#x60C; &#x648;&#x635;&#x646;&#x627;&#x62F;&#x64A;&#x642; &#x627;&#x644;&#x62A;&#x642;&#x627;&#x639;&#x62F; &#x60C; &#x648;&#x645;&#x62F;&#x64A;&#x631;&#x64A; &#x627;&#x644;&#x623;&#x635;&#x648;&#x644; &#x60C; &#x648;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x623;&#x645;&#x64A;&#x646; &#x639;&#x644;&#x649; &#x627;&#x644;&#x62D;&#x64A;&#x627;&#x629; &#x60C; &#x648;&#x635;&#x646;&#x627;&#x62F;&#x64A;&#x642; &#x627;&#x644;&#x62A;&#x62D;&#x648;&#x637; &#x60C; &#x648;&#x635;&#x646;&#x627;&#x62F;&#x64A;&#x642; &#x627;&#x644;&#x62B;&#x631;&#x648;&#x629; &#x627;&#x644;&#x633;&#x64A;&#x627;&#x62F;&#x64A;&#x629; &#x60C; &#x645;&#x646; &#x628;&#x64A;&#x646; &#x622;&#x62E;&#x631;&#x64A;&#x646;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x642;&#x627;&#x644;&#x62A; ILex &#x60C; &#x625;&#x646; &#x627;&#x644;&#x635;&#x646;&#x627;&#x62F;&#x64A;&#x642; &#x627;&#x644;&#x62C;&#x62F;&#x64A;&#x62F;&#x629; &#x633;&#x62A;&#x64F;&#x633;&#x62A;&#x62E;&#x62F;&#x645; &#x644;&#x62A;&#x637;&#x648;&#x64A;&#x631; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; &#x627;&#x644;&#x623;&#x648;&#x644; &#x645;&#x646; &#x645;&#x646;&#x635;&#x62A;&#x647;&#x627; &#x60C; &#x648;&#x627;&#x644;&#x62A;&#x64A; &#x633;&#x62A;&#x62A;&#x645;&#x64A;&#x632; &#x628;&#x645;&#x62D;&#x631;&#x643; &#x645;&#x637;&#x627;&#x628;&#x642;&#x629; &#x627;&#x644;&#x630;&#x643;&#x627;&#x621; &#x627;&#x644;&#x627;&#x635;&#x637;&#x646;&#x627;&#x639;&#x64A; &#x627;&#x644;&#x62E;&#x627;&#x635; &#x628;&#x647;&#x627; &#x60C; &#x648;&#x628;&#x631;&#x648;&#x62A;&#x648;&#x643;&#x648;&#x644;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x62F;&#x627;&#x648;&#x644; &#x60C; &#x648;&#x623;&#x62F;&#x627;&#x629; &#x62A;&#x62D;&#x644;&#x64A;&#x644; &#x627;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A;.&lt;/p&gt;
                &lt;p&gt;&#x645;&#x627; &#x627;&#x644;&#x645;&#x634;&#x643;&#x644;&#x629; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x62D;&#x644;&#x647;&#x627;&#x61F; &#x642;&#x627;&#x644; &#x628;&#x64A;&#x631;&#x62A;&#x631;&#x627;&#x646;&#x62F; &#x628;&#x64A;&#x644;&#x648;&#x646; &#x60C; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633; &#x627;&#x644;&#x62A;&#x646;&#x641;&#x64A;&#x630;&#x64A; &#x648;&#x627;&#x644;&#x645;&#x624;&#x633;&#x633; &#x644;&#x634;&#x631;&#x643;&#x629; iLex &#x60C; &#x625;&#x646;&#x647; &#x641;&#x64A; &#x62D;&#x64A;&#x646; &#x623;&#x646; &#x627;&#x644;&#x631;&#x642;&#x645;&#x646;&#x629; &#x642;&#x62F; &#x62D;&#x62F;&#x62B;&#x62A; &#x628;&#x627;&#x644;&#x641;&#x639;&#x644; &#x644;&#x628;&#x639;&#x636; &#x641;&#x626;&#x627;&#x62A; &#x627;&#x644;&#x623;&#x635;&#x648;&#x644; &#x645;&#x62B;&#x644; &#x627;&#x644;&#x623;&#x633;&#x647;&#x645; &#x648;&#x627;&#x644;&#x628;&#x648;&#x631;&#x635;&#x627;&#x62A; &#x627;&#x644;&#x623;&#x62C;&#x646;&#x628;&#x64A;&#x629; &#x60C; &#x644;&#x627; &#x64A;&#x632;&#x627;&#x644; &#x633;&#x648;&#x642; &#x642;&#x631;&#x648;&#x636; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x64A;&#x639;&#x62A;&#x645;&#x62F; &#x625;&#x644;&#x649; &#x62D;&#x62F; &#x643;&#x628;&#x64A;&#x631; &#x639;&#x644;&#x649; &#x627;&#x644;&#x639;&#x645;&#x644;&#x64A;&#x627;&#x62A; &#x627;&#x644;&#x64A;&#x62F;&#x648;&#x64A;&#x629; &#x63A;&#x64A;&#x631; &#x627;&#x644;&#x641;&#x639;&#x627;&#x644;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x641;&#x642;&#x64B;&#x627; &#x644;&#x644;&#x634;&#x631;&#x643;&#x629; &#x60C; &#x641;&#x625;&#x646; &#x646;&#x642;&#x627;&#x637; &#x627;&#x644;&#x636;&#x639;&#x641; &#x641;&#x64A; &#x627;&#x644;&#x633;&#x648;&#x642; &#x648;&#x627;&#x636;&#x62D;&#x629;: &#x627;&#x644;&#x648;&#x635;&#x648;&#x644; &#x627;&#x644;&#x645;&#x642;&#x64A;&#x62F; &#x625;&#x644;&#x649; &#x627;&#x644;&#x633;&#x648;&#x642; &#x628;&#x633;&#x628;&#x628; &#x627;&#x644;&#x645;&#x648;&#x627;&#x631;&#x62F; &#x627;&#x644;&#x645;&#x62D;&#x62F;&#x648;&#x62F;&#x629; &#x60C; &#x648;&#x646;&#x642;&#x635; &#x627;&#x644;&#x633;&#x64A;&#x648;&#x644;&#x629; &#x641;&#x64A; &#x627;&#x644;&#x625;&#x642;&#x631;&#x627;&#x636; &#x627;&#x644;&#x62B;&#x627;&#x646;&#x648;&#x64A; &#x60C; &#x648;&#x627;&#x643;&#x62A;&#x634;&#x627;&#x641; &#x627;&#x644;&#x623;&#x633;&#x639;&#x627;&#x631; &#x627;&#x644;&#x645;&#x646;&#x62E;&#x641;&#x636;&#x629; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x648;&#x649; &#x60C; &#x648;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x633;&#x648;&#x642; &#x627;&#x644;&#x645;&#x62D;&#x62F;&#x648;&#x62F;&#x629; &#x60C; &#x648;&#x627;&#x644;&#x627;&#x645;&#x62A;&#x62B;&#x627;&#x644; &#x648;&#x627;&#x644;&#x645;&#x62E;&#x627;&#x637;&#x631; &#x627;&#x644;&#x62A;&#x634;&#x63A;&#x64A;&#x644;&#x64A;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x644;&#x645;&#x639;&#x627;&#x644;&#x62C;&#x629; &#x647;&#x630;&#x647; &#x627;&#x644;&#x645;&#x634;&#x643;&#x644;&#x627;&#x62A; &#x60C; &#x633;&#x62A;&#x633;&#x627;&#x639;&#x62F; &#x627;&#x644;&#x62D;&#x644;&#x648;&#x644; &#x627;&#x644;&#x631;&#x642;&#x645;&#x64A;&#x629; &#x644;&#x644;&#x634;&#x631;&#x643;&#x629; &#x627;&#x644;&#x646;&#x627;&#x634;&#x626;&#x629; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645;&#x64A;&#x646; &#x639;&#x644;&#x649; &#x627;&#x644;&#x648;&#x635;&#x648;&#x644; &#x625;&#x644;&#x649; &#x627;&#x644;&#x635;&#x641;&#x642;&#x627;&#x62A; &#x627;&#x644;&#x639;&#x627;&#x644;&#x645;&#x64A;&#x629; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x646;&#x638;&#x627;&#x645; &#x645;&#x637;&#x627;&#x628;&#x642;&#x629; &#x627;&#x644;&#x630;&#x643;&#x627;&#x621; &#x627;&#x644;&#x627;&#x635;&#x637;&#x646;&#x627;&#x639;&#x64A; &#x60C; &#x62D;&#x633;&#x628;&#x645;&#x627; &#x630;&#x643;&#x631;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x641;&#x64A; &#x628;&#x64A;&#x627;&#x646;. &#x633;&#x62A;&#x642;&#x648;&#x645; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x628;&#x623;&#x62A;&#x645;&#x62A;&#x629; &#x62A;&#x646;&#x641;&#x64A;&#x630; &#x627;&#x644;&#x62A;&#x62F;&#x627;&#x648;&#x644; - &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x623;&#x62F;&#x648;&#x627;&#x62A; &#x627;&#x644;&#x625;&#x646;&#x62A;&#x627;&#x62C;&#x64A;&#x629; &#x648;&#x62A;&#x62A;&#x628;&#x639; &#x627;&#x644;&#x62A;&#x62F;&#x642;&#x64A;&#x642; &#x627;&#x644;&#x645;&#x631;&#x643;&#x632;&#x64A; - &#x648;&#x633;&#x62A;&#x648;&#x641;&#x631; &#x62A;&#x635;&#x648;&#x631;&#x64B;&#x627; &#x644;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x641;&#x64A; &#x627;&#x644;&#x648;&#x642;&#x62A; &#x627;&#x644;&#x641;&#x639;&#x644;&#x64A; &#x628;&#x627;&#x644;&#x625;&#x636;&#x627;&#x641;&#x629; &#x625;&#x644;&#x649; &#x622;&#x644;&#x64A;&#x627;&#x62A; &#x62A;&#x633;&#x639;&#x64A;&#x631; &#x627;&#x644;&#x642;&#x631;&#x648;&#x636; &#x648;&#x627;&#x644;&#x645;&#x639;&#x627;&#x64A;&#x64A;&#x631; &#x62D;&#x62A;&#x649; &#x64A;&#x62A;&#x645;&#x643;&#x646; &#x627;&#x644;&#x645;&#x633;&#x62A;&#x62E;&#x62F;&#x645;&#x648;&#x646; &#x645;&#x646; &#x627;&#x643;&#x62A;&#x633;&#x627;&#x628; &#x631;&#x624;&#x649; &#x639;&#x645;&#x64A;&#x642;&#x629; &#x644;&#x644;&#x633;&#x648;&#x642;.&lt;/p&gt;
                &lt;p&gt;&#x642;&#x627;&#x644; &#x628;&#x64A;&#x644;&#x648;&#x646;: &quot;&#x623;&#x639;&#x62A;&#x642;&#x62F; &#x623;&#x646; &#x627;&#x62E;&#x62A;&#x644;&#x627;&#x641;&#x646;&#x627; &#x64A;&#x643;&#x645;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x642;&#x648;&#x62F; &#x62D;&#x644;&#x648;&#x644;&#x646;&#x627; &#x648;&#x639;&#x631;&#x648;&#x636; &#x627;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x60C; &#x648;&#x627;&#x644;&#x623;&#x647;&#x645; &#x645;&#x646; &#x630;&#x644;&#x643; &#x60C; &#x634;&#x631;&#x627;&#x643;&#x627;&#x62A;&#x646;&#x627; &#x627;&#x644;&#x625;&#x633;&#x62A;&#x631;&#x627;&#x62A;&#x64A;&#x62C;&#x64A;&#x629; &#x645;&#x639; &#x627;&#x644;&#x644;&#x627;&#x639;&#x628;&#x64A;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x635;&#x646;&#x627;&#x639;&#x629;&quot;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x642;&#x62F; &#x623;&#x642;&#x627;&#x645;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629; &#x62D;&#x62A;&#x649; &#x627;&#x644;&#x622;&#x646; &#x634;&#x631;&#x627;&#x643;&#x627;&#x62A; &#x645;&#x639; &#x645;&#x632;&#x648;&#x62F; &#x627;&#x644;&#x645;&#x639;&#x644;&#x648;&#x645;&#x627;&#x62A; IHS Markit &#x648;&#x645;&#x642;&#x631;&#x647; &#x644;&#x646;&#x62F;&#x646; &#x648;&#x645;&#x632;&#x648;&#x62F; &#x627;&#x644;&#x628;&#x64A;&#x627;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x627;&#x644;&#x64A;&#x629; Refinitiv.&lt;/p&gt;
                &lt;p&gt;&#x645;&#x627; &#x647;&#x64A; &#x627;&#x644;&#x641;&#x631;&#x635;&#x629;&#x61F; &#x641;&#x64A; &#x645;&#x646;&#x637;&#x642;&#x629; &#x622;&#x633;&#x64A;&#x627; &#x648;&#x627;&#x644;&#x645;&#x62D;&#x64A;&#x637; &#x627;&#x644;&#x647;&#x627;&#x62F;&#x626; &#x60C; &#x628;&#x644;&#x63A;&#x62A; &#x642;&#x64A;&#x645;&#x629; &#x633;&#x648;&#x642; &#x627;&#x644;&#x642;&#x631;&#x648;&#x636; &#x627;&#x644;&#x645;&#x634;&#x62A;&#x631;&#x643;&#x629; &#x627;&#x644;&#x623;&#x648;&#x644;&#x64A;&#x629; &#x62D;&#x648;&#x627;&#x644;&#x64A; 700 &#x645;&#x644;&#x64A;&#x627;&#x631; &#x62F;&#x648;&#x644;&#x627;&#x631; &#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A; &#x627;&#x644;&#x639;&#x627;&#x645; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A; &#x60C; &#x641;&#x64A; &#x62D;&#x64A;&#x646; &#x642;&#x62F;&#x631;&#x62A; &#x633;&#x648;&#x642; &#x627;&#x644;&#x642;&#x631;&#x648;&#x636; &#x627;&#x644;&#x62B;&#x627;&#x646;&#x648;&#x64A;&#x629; &#x628;&#x62D;&#x648;&#x627;&#x644;&#x64A; 50 &#x645;&#x644;&#x64A;&#x627;&#x631; &#x62F;&#x648;&#x644;&#x627;&#x631; &#x623;&#x645;&#x631;&#x64A;&#x643;&#x64A; &#x60C; &#x648;&#x641;&#x642;&#x64B;&#x627; &#x644;&#x640; iLex.&lt;/p&gt;
                &lt;p&gt;&#x639;&#x644;&#x649; &#x645;&#x62F;&#x649; &#x627;&#x644;&#x633;&#x646;&#x648;&#x627;&#x62A; &#x627;&#x644;&#x62E;&#x645;&#x633; &#x627;&#x644;&#x645;&#x627;&#x636;&#x64A;&#x629; &#x60C; &#x643;&#x627;&#x646; &#x647;&#x646;&#x627;&#x643; 1200 &#x645;&#x642;&#x631;&#x636; &#x646;&#x634;&#x637; &#x648;&#x623;&#x643;&#x62B;&#x631; &#x645;&#x646; 12000 &#x645;&#x642;&#x62A;&#x631;&#x636; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x646;&#x637;&#x642;&#x629; &#x64A;&#x62D;&#x635;&#x644;&#x648;&#x646; &#x639;&#x644;&#x649; &#x631;&#x623;&#x633; &#x627;&#x644;&#x645;&#x627;&#x644; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x627;&#x644;&#x645;&#x639;&#x627;&#x645;&#x644;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x634;&#x62A;&#x631;&#x643;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x644;&#x643;&#x646; &#x641;&#x64A; &#x62D;&#x64A;&#x646; &#x623;&#x646; &#x625;&#x642;&#x631;&#x627;&#x636; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x647;&#x648; &#x627;&#x644;&#x645;&#x62D;&#x631;&#x643; &#x644;&#x644;&#x627;&#x642;&#x62A;&#x635;&#x627;&#x62F; &#x627;&#x644;&#x639;&#x627;&#x645; &#x60C; &#x643;&#x648;&#x646;&#x647; &#x62B;&#x627;&#x646;&#x64A; &#x623;&#x643;&#x628;&#x631; &#x645;&#x635;&#x62F;&#x631; &#x62A;&#x645;&#x648;&#x64A;&#x644; &#x644;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x60C; &#x641;&#x642;&#x62F; &#x630;&#x647;&#x628;&#x62A; &#x623;&#x642;&#x644; &#x645;&#x646; 1&#x66A; &#x645;&#x646; &#x627;&#x633;&#x62A;&#x62B;&#x645;&#x627;&#x631;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x627;&#x644;&#x645;&#x627;&#x644;&#x64A;&#x629; &#x625;&#x644;&#x649; &#x647;&#x630;&#x627; &#x627;&#x644;&#x642;&#x637;&#x627;&#x639; &#x60C; &#x62D;&#x633;&#x628;&#x645;&#x627; &#x644;&#x627;&#x62D;&#x638;&#x62A; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629;. &#x644;&#x630;&#x644;&#x643; &#x62A;&#x636;&#x639; ILex &#x646;&#x641;&#x633;&#x647;&#x627; &#x643;&#x634;&#x631;&#x643;&#x629; &#x631;&#x627;&#x626;&#x62F;&#x629; &#x641;&#x64A; &#x631;&#x642;&#x645;&#x646;&#x629; &#x627;&#x644;&#x635;&#x646;&#x627;&#x639;&#x629;.&lt;/p&gt;
                &lt;p&gt;&#x645;&#x627; &#x647;&#x64A; &#x62A;&#x62D;&#x62F;&#x64A;&#x627;&#x62A;&#x647;&#x627;&#x61F; &#x643;&#x645;&#x627; &#x647;&#x648; &#x627;&#x644;&#x62D;&#x627;&#x644; &#x645;&#x639; &#x623;&#x64A; &#x633;&#x648;&#x642; &#x631;&#x642;&#x645;&#x64A; &#x622;&#x62E;&#x631; &#x60C; &#x62A;&#x62F;&#x631;&#x643; iLex &#x623;&#x646;&#x647; &#x64A;&#x62A;&#x639;&#x64A;&#x646; &#x639;&#x644;&#x64A;&#x647;&#x627; &#x627;&#x644;&#x639;&#x645;&#x644; &#x628;&#x62C;&#x62F; &#x644;&#x62F;&#x641;&#x639; &#x627;&#x639;&#x62A;&#x645;&#x627;&#x62F; &#x646;&#x638;&#x627;&#x645;&#x647;&#x627; &#x627;&#x644;&#x623;&#x633;&#x627;&#x633;&#x64A; &#x648;&#x632;&#x64A;&#x627;&#x62F;&#x629; &#x62A;&#x62F;&#x641;&#x642; &#x627;&#x644;&#x635;&#x641;&#x642;&#x627;&#x62A; &#x648;&#x623;&#x62D;&#x62C;&#x627;&#x645;&#x647;&#x627;.&lt;/p&gt;
                &lt;p&gt;&#x648;&#x644;&#x62A;&#x62D;&#x642;&#x64A;&#x642; &#x630;&#x644;&#x643; &#x60C; &#x633;&#x62A;&#x631;&#x643;&#x632; &#x639;&#x644;&#x649; &#x62C;&#x630;&#x628; &#x645;&#x646;&#x638;&#x645;&#x64A; &#x62C;&#x627;&#x646;&#x628; &#x627;&#x644;&#x628;&#x64A;&#x639; &#x648;&#x645;&#x633;&#x62A;&#x62B;&#x645;&#x631;&#x64A; &#x62C;&#x627;&#x646;&#x628; &#x627;&#x644;&#x634;&#x631;&#x627;&#x621; &#x648;&#x627;&#x644;&#x627;&#x62D;&#x62A;&#x641;&#x627;&#x638; &#x628;&#x647;&#x645; &#x644;&#x62A;&#x635;&#x628;&#x62D; &#x623;&#x62F;&#x627;&#x629; &quot;&#x644;&#x627; &#x63A;&#x646;&#x649; &#x639;&#x646;&#x647;&#x627;&quot; &#x644;&#x644;&#x645;&#x634;&#x627;&#x631;&#x643;&#x64A;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x633;&#x648;&#x642; &#x60C; &#x639;&#x644;&#x649; &#x62D;&#x62F; &#x642;&#x648;&#x644; &#x627;&#x644;&#x634;&#x631;&#x643;&#x629;.&lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image19.jpg",
            "post_hits" => 4,
            "like" => 3,
            "created_at" => "2022-06-12 00:00:07",
            "updated_at" => "2022-06-12 00:00:07"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'أخبار'),
            $this->getTagIdByLanguageCode('ar', 'اكتشف بالي'),
            $this->getTagIdByLanguageCode('ar', 'الشركات الناشئة')
        ]);
        $post->translations()->sync([7]);

        # Post Translation Relations 22, 23, 24

        Translation::create([
            'id' => 8,
            'value' => json_encode([
                'en' => 22,
                'id' => 23,
                'ar' => 24,
            ])
        ]);

        # 22

        $post = Post::create([
            "id" => 22,
            "post_title" => "Envato - Top Digital Assets And Services",
            "post_name" => "envato-top-digital-assets-and-services",
            "post_summary" => html_entity_decode("&lt;p&gt;Join millions and bring your ideas and projects to life with Envato - the world&apos;s leading marketplace and community for creative assets and creative people.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Millions of people around the world choose our marketplace, studio and courses to buy files, hire freelancers, or learn the skills needed to build websites, videos, apps, graphics and more.&lt;/p&gt;&lt;p&gt;We&rsquo;re a values-based organization focused on community, entrepreneurship, diversity, and integrity. Envato is growing fast, with over 7 million community members in 2016, and we were named one of Australia&rsquo;s coolest companies for women and coolest companies in tech in 2015.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;../../../../storage/images/content22.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;We&rsquo;ve got a lot going on at Envato, so here&rsquo;s the overview of our main products and marketplaces:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Envato Market is a collection of marketplaces for creative digital assets. This includes:&lt;/li&gt;&lt;li&gt;ThemeForest (website templates and WordPress themes)&lt;/li&gt;&lt;li&gt;CodeCanyon (Code, Plugins, and mobile)&lt;/li&gt;&lt;li&gt;VideoHive (motion graphics)&lt;/li&gt;&lt;li&gt;AudioJungle (stock music and audio)&lt;/li&gt;&lt;li&gt;GraphicRiver (graphics, vectors, and illustrations)&lt;/li&gt;&lt;li&gt;PhotoDune (photography)&lt;/li&gt;&lt;li&gt;3DOcean (3D models and materials)&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Reource: &lt;a href=&quot;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&quot; target=&quot;_blank&quot;&gt;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&lt;/a&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image22.jpg",
            "post_hits" => 4,
            "like" => 4,
            "created_at" => "2022-06-12 00:00:07",
            "updated_at" => "2022-06-12 00:00:07"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Marketplace'),
            $this->getTagIdByLanguageCode('en', 'Envato'),
            $this->getTagIdByLanguageCode('en', 'Creative Market'),
            $this->getTagIdByLanguageCode('en', 'Digital Creative')
        ]);
        $post->translations()->attach(8);

        # 23

        $post = Post::create([
            "id" => 23,
            "post_title" => "Envato - Aset dan Layanan Digital Teratas",
            "post_name" => "envato-aset-dan-layanan-digital-teratas",
            "post_summary" => html_entity_decode("&lt;p&gt;Bergabunglah dengan jutaan orang dan wujudkan ide dan proyek Anda dengan Envato - pasar dan komunitas terkemuka di dunia untuk aset kreatif dan orang-orang kreatif.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Jutaan orang di seluruh dunia memilih pasar, studio, dan kursus kami untuk membeli file, menyewa pekerja lepas, atau mempelajari keterampilan yang diperlukan untuk membuat situs web, video, aplikasi, grafik, dan banyak lagi.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Kami adalah organisasi berbasis nilai yang berfokus pada komunitas, kewirausahaan, keragaman, dan integritas. Envato berkembang pesat, dengan lebih dari 7 juta anggota komunitas pada tahun 2016, dan kami dinobatkan sebagai salah satu perusahaan paling keren di Australia untuk wanita dan perusahaan paling keren di bidang teknologi pada tahun 2015.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;../../../../storage/images/content22.png&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Kami memiliki banyak hal yang terjadi di Envato, jadi inilah ikhtisar produk dan pasar utama kami:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Envato Market adalah kumpulan pasar untuk aset digital kreatif. Ini termasuk:&lt;/span&gt;&lt;/li&gt;&lt;li&gt;ThemeForest (templat situs web dan tema WordPress)&lt;/li&gt;&lt;li&gt;CodeCanyon (Kode, Plugin, dan seluler)&lt;/li&gt;&lt;li&gt;VideoHive (grafik gerak)&lt;/li&gt;&lt;li&gt;AudioJungle (musik dan audio stok)&lt;/li&gt;&lt;li&gt;GraphicRiver (grafik, vektor, dan ilustrasi)&lt;/li&gt;&lt;li&gt;PhotoDune (fotografi)&lt;/li&gt;&lt;li&gt;3DOcean (model dan bahan 3D)&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Sumber: &lt;a href=&quot;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&quot; target=&quot;_blank&quot;&gt;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&lt;/a&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image22.jpg",
            "post_hits" => 3,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:07",
            "updated_at" => "2022-06-12 00:00:07"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Pasar'),
            $this->getTagIdByLanguageCode('id', 'Envato'),
            $this->getTagIdByLanguageCode('id', 'Pasar Kreatif'),
            $this->getTagIdByLanguageCode('id', 'Kreatif Digital')
        ]);
        $post->translations()->attach(8);

        # 24

        $post = Post::create([
            "id" => 24,
            "post_title" => "Envato - أفضل الأصول والخدمات الرقمية",
            "post_name" => "envato-afdl-lasol-o-lkhdm-t-lrkmy",
            "post_summary" => "<p>انضم إلى الملايين واجعل أفكارك ومشاريعك تنبض بالحياة مع Envato - السوق والمجتمع الرائدين في العالم للأصول الإبداعية والأشخاص المبدعين.</p>",
            "post_content" => html_entity_decode("&lt;p&gt;&#x64A;&#x62E;&#x62A;&#x627;&#x631; &#x645;&#x644;&#x627;&#x64A;&#x64A;&#x646; &#x627;&#x644;&#x623;&#x634;&#x62E;&#x627;&#x635; &#x62D;&#x648;&#x644; &#x627;&#x644;&#x639;&#x627;&#x644;&#x645; &#x633;&#x648;&#x642;&#x646;&#x627; &#x648;&#x627;&#x633;&#x62A;&#x648;&#x62F;&#x64A;&#x648;&#x646;&#x627; &#x648;&#x62F;&#x648;&#x631;&#x627;&#x62A;&#x646;&#x627; &#x627;&#x644;&#x62A;&#x62F;&#x631;&#x64A;&#x628;&#x64A;&#x629; &#x644;&#x634;&#x631;&#x627;&#x621; &#x627;&#x644;&#x645;&#x644;&#x641;&#x627;&#x62A; &#x623;&#x648; &#x62A;&#x648;&#x638;&#x64A;&#x641; &#x645;&#x648;&#x638;&#x641;&#x64A;&#x646; &#x645;&#x633;&#x62A;&#x642;&#x644;&#x64A;&#x646; &#x623;&#x648; &#x62A;&#x639;&#x644;&#x645; &#x627;&#x644;&#x645;&#x647;&#x627;&#x631;&#x627;&#x62A; &#x627;&#x644;&#x644;&#x627;&#x632;&#x645;&#x629; &#x644;&#x625;&#x646;&#x634;&#x627;&#x621; &#x645;&#x648;&#x627;&#x642;&#x639; &#x627;&#x644;&#x648;&#x64A;&#x628; &#x648;&#x645;&#x642;&#x627;&#x637;&#x639; &#x627;&#x644;&#x641;&#x64A;&#x62F;&#x64A;&#x648; &#x648;&#x627;&#x644;&#x62A;&#x637;&#x628;&#x64A;&#x642;&#x627;&#x62A; &#x648;&#x627;&#x644;&#x631;&#x633;&#x648;&#x645;&#x627;&#x62A; &#x648;&#x627;&#x644;&#x645;&#x632;&#x64A;&#x62F;.&lt;/p&gt;
                &lt;p&gt;&#x646;&#x62D;&#x646; &#x645;&#x646;&#x638;&#x645;&#x629; &#x642;&#x627;&#x626;&#x645;&#x629; &#x639;&#x644;&#x649; &#x627;&#x644;&#x642;&#x64A;&#x645; &#x62A;&#x631;&#x643;&#x632; &#x639;&#x644;&#x649; &#x627;&#x644;&#x645;&#x62C;&#x62A;&#x645;&#x639; &#x648;&#x631;&#x64A;&#x627;&#x62F;&#x629; &#x627;&#x644;&#x623;&#x639;&#x645;&#x627;&#x644; &#x648;&#x627;&#x644;&#x62A;&#x646;&#x648;&#x639; &#x648;&#x627;&#x644;&#x646;&#x632;&#x627;&#x647;&#x629;. &#x64A;&#x646;&#x645;&#x648; Envato &#x628;&#x633;&#x631;&#x639;&#x629; &#x60C; &#x645;&#x639; &#x623;&#x643;&#x62B;&#x631; &#x645;&#x646; 7 &#x645;&#x644;&#x627;&#x64A;&#x64A;&#x646; &#x639;&#x636;&#x648; &#x641;&#x64A; &#x627;&#x644;&#x645;&#x62C;&#x62A;&#x645;&#x639; &#x641;&#x64A; &#x639;&#x627;&#x645; 2016 &#x60C; &#x648;&#x62A;&#x645; &#x627;&#x62E;&#x62A;&#x64A;&#x627;&#x631;&#x646;&#x627; &#x643;&#x648;&#x627;&#x62D;&#x62F;&#x629; &#x645;&#x646; &#x623;&#x631;&#x648;&#x639; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x641;&#x64A; &#x623;&#x633;&#x62A;&#x631;&#x627;&#x644;&#x64A;&#x627; &#x644;&#x644;&#x646;&#x633;&#x627;&#x621; &#x648;&#x623;&#x631;&#x648;&#x639; &#x627;&#x644;&#x634;&#x631;&#x643;&#x627;&#x62A; &#x641;&#x64A; &#x645;&#x62C;&#x627;&#x644; &#x627;&#x644;&#x62A;&#x643;&#x646;&#x648;&#x644;&#x648;&#x62C;&#x64A;&#x627; &#x641;&#x64A; &#x639;&#x627;&#x645; 2015.&lt;/p&gt;
                &lt;p&gt;&lt;img src=&quot;../../../../storage/images/content22.png&quot;&gt;&lt;br&gt;&lt;/p&gt;
                &lt;p&gt;&#x644;&#x62F;&#x64A;&#x646;&#x627; &#x627;&#x644;&#x643;&#x62B;&#x64A;&#x631; &#x645;&#x645;&#x627; &#x64A;&#x62C;&#x631;&#x64A; &#x641;&#x64A; Envato &#x60C; &#x644;&#x630;&#x627; &#x625;&#x644;&#x64A;&#x643; &#x646;&#x638;&#x631;&#x629; &#x639;&#x627;&#x645;&#x629; &#x639;&#x644;&#x649; &#x645;&#x646;&#x62A;&#x62C;&#x627;&#x62A;&#x646;&#x627; &#x648;&#x623;&#x633;&#x648;&#x627;&#x642;&#x646;&#x627; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633;&#x64A;&#x629;:&lt;/p&gt;
                &lt;ul&gt;
                &lt;li&gt; &#x633;&#x648;&#x642; Envato &#x639;&#x628;&#x627;&#x631;&#x629; &#x639;&#x646; &#x645;&#x62C;&#x645;&#x648;&#x639;&#x629; &#x645;&#x646; &#x627;&#x644;&#x623;&#x633;&#x648;&#x627;&#x642; &#x644;&#x644;&#x623;&#x635;&#x648;&#x644; &#x627;&#x644;&#x631;&#x642;&#x645;&#x64A;&#x629; &#x627;&#x644;&#x625;&#x628;&#x62F;&#x627;&#x639;&#x64A;&#x629;. &#x648;&#x647;&#x630;&#x627; &#x64A;&#x634;&#x645;&#x644;: &lt;/ li&gt;
                &lt;li&gt; ThemeForest (&#x642;&#x648;&#x627;&#x644;&#x628; &#x645;&#x648;&#x627;&#x642;&#x639; &#x627;&#x644;&#x648;&#x64A;&#x628; &#x648;&#x645;&#x648;&#x636;&#x648;&#x639;&#x627;&#x62A; WordPress) &lt;/li&gt;
                &lt;li&gt; CodeCanyon (&#x627;&#x644;&#x631;&#x645;&#x632; &#x648;&#x627;&#x644;&#x645;&#x643;&#x648;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x625;&#x636;&#x627;&#x641;&#x64A;&#x629; &#x648;&#x627;&#x644;&#x62C;&#x648;&#x627;&#x644;) &lt;/li&gt;
                &lt;li&gt; VideoHive (&#x627;&#x644;&#x631;&#x633;&#x648;&#x645; &#x627;&#x644;&#x645;&#x62A;&#x62D;&#x631;&#x643;&#x629;) &lt;/li&gt;
                &lt;li&gt; AudioJungle (&#x645;&#x62E;&#x632;&#x648;&#x646; &#x627;&#x644;&#x645;&#x648;&#x633;&#x64A;&#x642;&#x649; &#x648;&#x627;&#x644;&#x635;&#x648;&#x62A;) &lt;/li&gt;
                &lt;li&gt; GraphicRiver (&#x631;&#x633;&#x648;&#x645;&#x627;&#x62A; &#x648;&#x645;&#x62A;&#x62C;&#x647;&#x627;&#x62A; &#x648;&#x631;&#x633;&#x648;&#x645; &#x62A;&#x648;&#x636;&#x64A;&#x62D;&#x64A;&#x629;) &lt;/li&gt;
                &lt;li&gt; &#x641;&#x648;&#x62A;&#x648;&#x62F;&#x648;&#x646; (&#x62A;&#x635;&#x648;&#x64A;&#x631;) &lt;/ li&gt;
                &lt;li&gt; 3DOcean (&#x646;&#x645;&#x627;&#x630;&#x62C; &#x648;&#x645;&#x648;&#x627;&#x62F; &#x62B;&#x644;&#x627;&#x62B;&#x64A;&#x629; &#x627;&#x644;&#x623;&#x628;&#x639;&#x627;&#x62F;) &lt;/li&gt;
                &lt;/ul&gt;
                &lt;p&gt;&#x627;&#x644;&#x645;&#x648;&#x627;&#x631;&#x62F;: &lt;a href=&quot;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&quot; target=&quot;_blank&quot;&gt;https://themeforest.net/category/site-templates?sort=date&amp;amp;term=real%20estate#content&lt;/a&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image22.jpg",
            "post_hits" => 4,
            "like" => 4,
            "created_at" => "2022-06-12 00:00:08",
            "updated_at" => "2022-06-12 00:00:08"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'المتجر'),
            $this->getTagIdByLanguageCode('ar', 'إنفاتو'),
            $this->getTagIdByLanguageCode('ar', 'سوق إبداعي'),
            $this->getTagIdByLanguageCode('ar', 'الإبداع الرقمي')
        ]);
        $post->translations()->sync([8]);

        # Post Translation Relations 25, 26, 27

        Translation::create([
            'id' => 9,
            'value' => json_encode([
                'en' => 25,
                'id' => 26,
                'ar' => 37,
            ])
        ]);

        # 25

        $post = Post::create([
            "id" => 25,
            "post_title" => "Bootstrap 5 Alpha Finally Launched!",
            "post_name" => "bootstrap-5-alpha-finally-launched",
            "post_summary" => html_entity_decode("&lt;p&gt;Bootstrap 5&rsquo;s very first alpha has arrived! We&rsquo;ve been working hard for several months to refine the work we started in v4, and while we&rsquo;re feeling great about our progress, there&rsquo;s still even more to do.&lt;br&gt;&lt;/p&gt;"),
            "post_content" => html_entity_decode("&#x3C;p&#x3E;We&#x2019;ve been focused on making the migration from v4 to v5 more approachable, but we&#x2019;ve also not been afraid to step away from what&#x2019;s outdated or no longer appropriate. As such, we&#x2019;re very happy to say that with v5, Bootstrap no longer depends on jQuery and we&#x2019;ve dropped support for Internet Explorer. We&#x2019;re sharpening our focus on building tools that are more future-friendly, and while we&#x2019;re not fully there yet, the promise of CSS variables, faster JavaScript, fewer dependencies, and better APIs certainly feel right to us.&#x3C;/p&#x3E;&#x3C;p&#x3E;Before you jump to updating, please remember v5 is now in alpha&#x2014;breaking changes will continue to occur until our first beta. We haven&#x2019;t finished adding or removing everything, so check for open issues and pull requests as you have questions or feedback.&#x3C;/p&#x3E;&#x3C;p&#x3E;Now let&#x2019;s dig in with some highlights!&#x3C;/p&#x3E;&#x3C;h3&#x3E;New look and feel&#x3C;/h3&#x3E;&#x3C;p&#x3E;We&#x2019;ve built on the improvements to our docs homepage in v4.5.0 with an updated look and feel for the rest of our docs. Our docs pages are no longer full-width to improve readability and make our site feel less app-like and more content-like. In addition, we&#x2019;ve upgraded our sidebar to use expandable sections (powered by our own Collapse plugin) for faster navigation.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-home.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;We&#x2019;re also sporting a brand new logo! More on that when v5 goes stable, but suffice to say we wanted to give the ol&#x2019; B in a rounded square a small upgrade.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-new-logo.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;Inspired by the CSS that created the very beginnings of this project, our logo embodies the feeling of a rule set&#x2014;style bounded by curly braces. We love it and think you will, too. Expect to see it roll out to v4&#x2019;s documentation, our blog, and more over time as we continue to refine things and ship new releases.&#x3C;/p&#x3E;&#x3C;h3&#x3E;jQuery and JavaScript&#x3C;/h3&#x3E;&#x3C;p&#x3E;jQuery brought unprecedented access to complex JavaScript behaviors to millions (billions?) of people over the last decade and a half. Personally, I&#x2019;m forever grateful for the empowerment and support it gave me to continue writing front-end code, learning new things, and embracing plugins from the community. Perhaps most importantly, it&#x2019;s forever changed JavaScript itself, and that in itself is a monument to jQuery&#x2019;s success. Thank you to every jQuery contributor and maintainer who made that possible for folks like me.&#x3C;/p&#x3E;&#x3C;p&#x3E;Thanks to advancement made in front-end development tools and browser support, we&#x2019;re now able to drop jQuery as a dependency, but you&#x2019;d never notice otherwise. This migration was a huge undertaking by @Johann-S, our primary JavaScript maintainer these days. It marks one of the largest changes to the framework in years and means projects built on Bootstrap 5 will be significantly lighter on file size and page load moving forward.&#x3C;/p&#x3E;&#x3C;p&#x3E;In addition to dropping jQuery, we&#x2019;ve made a handful of other changes and enhancements to our JavaScript in v5 that focus on code quality and bridging the gap between v4 and v5. One of our other larger changes was dropping the bulk of our Button plugin for an HTML and CSS only approach to toggle states. Now toggle buttons are powered by checkboxes and radio buttons and are much more reliable.&#x3C;/p&#x3E;&#x3C;p&#x3E;You can see the full list of JS related changes in the first v5 alpha project on GitHub.&#x3C;/p&#x3E;&#x3C;p&#x3E;Interested in helping out on Bootstrap&#x2019;s JavaScript? We&#x2019;re always looking for new contributors to the team to help write new plugins, review pull requests, and fix bugs. Let us know!&#x3C;/p&#x3E;&#x3C;h3&#x3E;CSS custom properties&#x3C;/h3&#x3E;&#x3C;p&#x3E;As mentioned, we&#x2019;ve begun using CSS custom properties in Bootstrap 5 thanks to dropping support for Internet Explorer. In v4 we only included a handful of root variables for color and fonts, and now we&#x2019;ve added them for a handful of components and layout options.&#x3C;/p&#x3E;&#x3C;p&#x3E;Take for example our .table component, where we&#x2019;ve added a handful of local variables to make striped, hoverable, and active table styles easier:&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-css&#x22;&#x3E;&#x3C;code class=&#x22;language-css&#x22;&#x3E;.table {
                --bs-table-bg: #{&#36;table-bg};
                --bs-table-accent-bg: transparent;
                --bs-table-striped-color: #{&#36;table-striped-color};
                --bs-table-striped-bg: #{&#36;table-striped-bg};
                --bs-table-active-color: #{&#36;table-active-color};
                --bs-table-active-bg: #{&#36;table-active-bg};
                --bs-table-hover-color: #{&#36;table-hover-color};
                --bs-table-hover-bg: #{&#36;table-hover-bg};

                // Styles here...
                }&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;We&#x2019;re working to utilize the superpowers of both Sass and CSS custom properties for a more flexible system. You can read more about this in the Tables docs page and expect to see more usage in components like buttons in the near future.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Improved customizing docs&#x3C;/h3&#x3E;&#x3C;p&#x3E;We&#x2019;ve hunkered down and improved our documentation in several places, giving more explanation, removing ambiguity, and providing much more support for extending Bootstrap. It all starts with a whole new Customize section.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://user-images.githubusercontent.com/98681/84740682-ac43c600-af62-11ea-88a4-79c1362061c8.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;v5&#x2019;s Customize docs expand on v4&#x2019;s Theming page with more content and code snippets for building on top of Bootstrap&#x2019;s source Sass files. We&#x2019;ve fleshed out more content here and even provided a starter npm project for you to get started with faster and easier. It&#x2019;s also available as a template repo on GitHub, so you can freely fork and go.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://user-images.githubusercontent.com/98681/84801339-e5585680-afb3-11ea-8743-29647ff3f3a9.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;We&#x2019;ve expanded our color palette in v5, too. With an extensive color system built-in, you can more easily customize the look and feel of your app without ever leaving the codebase. We&#x2019;ve also done some work to improve color contrast, and even provided color contrast metrics in our Color docs. Hopefully, this will continue to help make Bootstrap-powered sites more accessible to folks all over.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Updated forms&#x3C;/h3&#x3E;&#x3C;p&#x3E;In addition to the new Customize section, we&#x2019;ve overhauled our Forms documentation and components. We&#x2019;ve consolidated all our forms styles into a new Forms section (including the input group component) to give them the emphasis they deserve.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-forms.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;&#x3C;/p&#x3E;&#x3C;p&#x3E;Alongside new docs pages, we&#x2019;ve redesigned and de-duped all our form controls. In v4 we introduced an extensive suite of custom form controls&#x2014;checks, radios, switches, files, and more&#x2014;but those were in addition to whatever defaults each browser provided. With v5, we&#x2019;ve gone fully custom.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x3C;img src=&#x22;https://blog.getbootstrap.com/assets/img/2020/06/v5-checks.png&#x22; style=&#x22;width: 645px;&#x22;&#x3E;If you&#x2019;re familiar with v4&#x2019;s form markup, this shouldn&#x2019;t look too far off for you. With a single set of form controls and a focus on redesigning existing elements vs generating new ones via pseudo-elements, we have a much more consistent look and feel.&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-html&#x22;&#x3E;&#x3C;code class=&#x22;language-html&#x22;&#x3E;&#x26;lt;div class=&#x22;form-check&#x22;&#x26;gt;
                &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;checkbox&#x22; value=&#x22;&#x22; id=&#x22;flexCheckDefault&#x22;&#x26;gt;
                &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexCheckDefault&#x22;&#x26;gt;
                    Default checkbox
                &#x26;lt;/label&#x26;gt;
                &#x26;lt;/div&#x26;gt;

                &#x26;lt;div class=&#x22;form-check&#x22;&#x26;gt;
                &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;radio&#x22; name=&#x22;flexRadioDefault&#x22; id=&#x22;flexRadioDefault1&#x22;&#x26;gt;
                &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexRadioDefault1&#x22;&#x26;gt;
                    Default radio
                &#x26;lt;/label&#x26;gt;
                &#x26;lt;/div&#x26;gt;

                &#x26;lt;div class=&#x22;form-check form-switch&#x22;&#x26;gt;
                &#x26;lt;input class=&#x22;form-check-input&#x22; type=&#x22;checkbox&#x22; id=&#x22;flexSwitchCheckDefault&#x22;&#x26;gt;
                &#x26;lt;label class=&#x22;form-check-label&#x22; for=&#x22;flexSwitchCheckDefault&#x22;&#x26;gt;Default switch checkbox input&#x26;lt;/label&#x26;gt;
                &#x26;lt;/div&#x26;gt;&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Every checkbox, radio, select, file, range, and more
                includes a custom appearance to unify the style and behavior of form controls across OS and browser. These new form
                controls are all built on completely semantic, standard form controls&#x2014;no more superfluous markup, just form
                controls and labels.&#x3C;/p&#x3E;&#x3C;p&#x3E;Be sure to explore the new forms docs and let us know what you
                think.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Utilities API&#x3C;/h3&#x3E;&#x3C;p&#x3E;We love seeing how many folks are building
                new and interesting CSS libraries and toolkits, challenging the way we&#x2019;ve built on the web for the last
                decade-plus. It&#x2019;s refreshing, to say the least, and affords us all an opportunity to discuss and iterate. As
                such, we&#x2019;ve implemented a brand new utility API into Bootstrap 5.&#x3C;/p&#x3E;&#x3C;pre
                class=&#x22;language-sas&#x22;&#x3E;&#x3C;code class=&#x22;language-sas&#x22;&#x3E;&#36;utilities: () !default;
                &#36;utilities: map-merge(
                (
                    // ...
                    &#x22;width&#x22;: (
                    property: width,
                    class: w,
                    values: (
                        25: 25%,
                        50: 50%,
                        75: 75%,
                        100: 100%,
                        auto: auto
                    )
                    ),
                    // ...
                    &#x22;margin&#x22;: (
                    responsive: true,
                    property: margin,
                    class: m,
                    values: map-merge(&#36;spacers, (auto: auto))
                    ),
                    // ...
                ), &#36;utilities);&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Ever since utilities become a preferred way to build,
                we&#x2019;ve been working to find the right balance to implement them in Bootstrap while providing control and
                customization. In v4, we did this with global &#36;enable-* classes, and we&#x2019;ve even carried that forward in v5.
                But
                with an API based approach, we&#x2019;ve created a language and syntax in Sass to create your own utilities on the fly
                while also being able to modify or remove those we provide. This is all thanks to @MartijnCuppens, who also maintains
                the RFS project, and is responsible for the initial PR and subsequent improvements.&#x3C;/p&#x3E;&#x3C;p&#x3E;We think
                this will be a game-changer for those who build on Bootstrap via our source files, and if you haven&#x2019;t built a
                Bootstrap-powered project that way yet, your mind will be blown.&#x3C;/p&#x3E;&#x3C;p&#x3E;Heads up! We&#x2019;ve
                moved some of our former v4 utilities to a new Helpers section. These helpers are snippets of code that are longer
                than your usual property-value pairing for our utilities. Just our way of reorganizing things for easier naming and
                improved documentation.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Enhanced grid system&#x3C;/h3&#x3E;&#x3C;p&#x3E;By design Bootstrap
                5 isn&#x2019;t a complete departure from v4. We wanted everyone to be able to more easily upgrade to this future
                version after hearing about the difficulties from the v3 to v4 upgrade path. We&#x2019;ve kept the bulk of the build
                system in place (minus jQuery) for this reason, and we&#x2019;ve also built on the existing grid system instead of
                replacing it with something newer and hipper.&#x3C;/p&#x3E;&#x3C;p&#x3E;Here&#x2019;s a rundown of what&#x2019;s
                changed in our grid:&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;We&#x2019;ve added a new grid tier! Say hello to
                xxl.&#x3C;/li&#x3E;&#x3C;li&#x3E;.gutter classes have been replaced with .g* utilities, much like our margin/padding
                utilities. We&#x2019;ve also added options to your grid gutter spacing that matches the spacing utilities
                you&#x2019;re already familiar with.&#x3C;/li&#x3E;&#x3C;li&#x3E;Form layout options have been replaced with the new
                grid system.&#x3C;/li&#x3E;&#x3C;li&#x3E;Vertical spacing classes have been added.&#x3C;/li&#x3E;&#x3C;li&#x3E;Columns
                are no longer position: relative by default.&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;Here&#x2019;s a quick example
                of how to use the new grid gutter classes:&#x3C;/p&#x3E;&#x3C;pre class=&#x22;language-html&#x22;&#x3E;&#x3C;code
                class=&#x22;language-html&#x22;&#x3E;&#x26;lt;div class=&#x22;row g-5&#x22;&#x26;gt;
                &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
                &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
                &#x26;lt;div class=&#x22;col&#x22;&#x26;gt;...&#x26;lt;/div&#x26;gt;
                &#x26;lt;/div&#x26;gt;&#x3C;/code&#x3E;&#x3C;/pre&#x3E;&#x3C;p&#x3E;Take a look at the redesigned and restructured Layout docs to learn more.&#x3C;/p&#x3E;&#x3C;p&#x3E;CSS&#x2019;s grid layout is increasingly ready for prime time, and while we haven&#x2019;t made use of it here yet, we&#x2019;re continuing to experiment and learn from it. Look to future releases of v5 to embrace it in more ways.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Docs&#x3C;/h3&#x3E;&#x3C;p&#x3E;We switched our documentation static site generator from Jekyll to Hugo. Jekyll has long been our generator of choice given how easy it is to get up and running, and its simplicity with deploying to GitHub Pages.&#x3C;/p&#x3E;&#x3C;p&#x3E;Unfortunately, we&#x2019;ve reached two major issues with Jekyll over the years:&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;Jekyll requires Ruby to be installed&#x3C;/li&#x3E;&#x3C;li&#x3E;Site generation was very slow&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;Hugo on the other hand is written in Go, so it has no external runtime dependencies, and it&#x2019;s much faster. We build our current master branch site, including the doc&#x2019;s Sass -&#x26;gt; CSS in ~1.6s. Our local server reloads in milliseconds instead of 8-12 seconds, so working on the docs has become a pleasant experience again.&#x3C;/p&#x3E;&#x3C;p&#x3E;The Hugo switch wouldn&#x2019;t have been possible without Hugo&#x2019;s main developer work, Bj&#xF8;rn Erik Pedersen (@bep), who made quite a few codebase changes to make the transition possible and smooth!&#x3C;/p&#x3E;&#x3C;p&#x3E;Also a shoutout to @xhmikosr who led the charge here in converting hundreds of files and working with the Hugo developers to make sure our local development was fast, efficient, and maintainable.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Coming soon: RTL, offcanvas, and more&#x3C;/h3&#x3E;&#x3C;p&#x3E;There&#x2019;s a ton we just didn&#x2019;t have time to tackle in our first alpha that&#x2019;s still on the todo list for future alphas. We wanted to give them some love here so you know what&#x2019;s on our radar throughout v5&#x2019;s development.&#x3C;/p&#x3E;&#x3C;ul&#x3E;&#x3C;li&#x3E;RTL is coming! We&#x2019;ve spiked out a PR using RTLCSS and are continuing to explore logical properties as well. Personally, I&#x2019;m sorry for taking so long for us to officially tackle this knowing all the effort that&#x2019;s gone into it community efforts and pull requests to the project. Hopefully, the wait is worth it.&#x3C;/li&#x3E;&#x3C;li&#x3E;There&#x2019;s a forked version of our modal that&#x2019;s implementing an offcanvas menu. We still have some work to do here to get this right without adding too much overhead, but the idea of having an offcanvas wrapper to place any sidebar-worth content&#x2014;navigation, shopping cart, etc&#x2014;is huge. Personally, I know we&#x2019;re behind the times on this one, but it should be awesome nonetheless.&#x3C;/li&#x3E;&#x3C;li&#x3E;We&#x2019;re evaluating a number of other changes to our codebase, including the Sass module system, increased usage of CSS custom properties, embedding SVGs in our HTML instead of our CSS, and more.&#x3C;/li&#x3E;&#x3C;/ul&#x3E;&#x3C;p&#x3E;There&#x2019;s a ton yet to come, including more documentation improvements, bug fixes, and quality of life changes. Be sure to review our open issues and PRs to see where you can help out by providing feedback, testing community PRs, or sharing your ideas.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Get started&#x3C;/h3&#x3E;&#x3C;p&#x3E;Head to https://v5.getbootstrap.com to explore the new release. We&#x2019;ve also published this updated as a pre-release to npm, so if you&#x2019;re feeling bold or are curious about what&#x2019;s new, you can pull the latest in that way.&#x3C;/p&#x3E;&#x3C;p&#x3E;npm i bootstrap@next&#x3C;/p&#x3E;&#x3C;h3&#x3E;What&#x2019;s next&#x3C;/h3&#x3E;&#x3C;p&#x3E;We still have more work to do in v5, including some breaking changes, but we&#x2019;re incredibly excited about this release. Let the feedback rip and we&#x2019;ll do our best to keep up with y&#x2019;all. Our goal is to ship another alpha within 3-4 weeks, and likely a couple more after that. We&#x2019;ll also be shipping a v4.5.1 release to fix a couple of regressions and continue to bridge the gap between v4 and v5.&#x3C;/p&#x3E;&#x3C;p&#x3E;Beyond that, keep an eye for more updates to the Bootstrap Icons project, our RFS project (now enabled by default in v5), and the npm starter project.&#x3C;/p&#x3E;&#x3C;h3&#x3E;Support the team&#x3C;/h3&#x3E;&#x3C;p&#x3E;Visit our Open Collective page or our team members&#x2019; GitHub profiles to help support the maintainers contributing to Bootstrap.&#x3C;/p&#x3E;&#x3C;p&#x3E;&#x26;lt;3,&#x3C;/p&#x3E;&#x3C;p&#x3E;@mdo &#x26;amp; team&#x3C;/p&#x3E;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image25.jpg",
            "post_hits" => 5,
            "like" => 5,
            "created_at" => "2022-06-12 00:00:08",
            "updated_at" => "2022-06-12 00:00:08"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Framework'),
            $this->getTagIdByLanguageCode('en', 'Bootstrap'),
            $this->getTagIdByLanguageCode('en', 'HTML'),
            $this->getTagIdByLanguageCode('en', 'CSS')
        ]);
        $post->translations()->attach(9);

        # 26

        $post = Post::create([
            "id" => 26,
            "post_title" => "Bootstrap 5 Alpha Akhirnya Diluncurkan!",
            "post_name" => "bootstrap-5-alpha-akhirnya-diluncurkan",
            "post_summary" => html_entity_decode("&lt;p&gt;Alpha pertama Bootstrap 5 telah tiba! Kami telah bekerja keras selama beberapa bulan untuk menyempurnakan pekerjaan yang kami mulai di v4, dan sementara kami merasa senang dengan kemajuan kami, masih ada lebih banyak lagi yang harus dilakukan.&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;Kami telah fokus untuk membuat migrasi dari v4 ke v5 lebih mudah didekati, tetapi kami juga tidak takut untuk menjauh dari apa yang sudah ketinggalan zaman atau tidak lagi sesuai. Karena itu, kami sangat senang untuk mengatakan bahwa dengan v5, Bootstrap tidak lagi bergantung pada jQuery dan kami telah menghentikan dukungan untuk Internet Explorer. Kami mempertajam fokus kami untuk membangun alat yang lebih ramah masa depan, dan meskipun kami belum sepenuhnya melakukannya, janji variabel CSS, JavaScript yang lebih cepat, lebih sedikit ketergantungan, dan API yang lebih baik tentu terasa tepat bagi kami.&lt;/p&gt;&lt;p&gt;Sebelum Anda melompat ke pembaruan, harap diingat v5 sekarang dalam versi alfa&mdash;perubahan yang melanggar akan terus terjadi hingga beta pertama kami. Kami belum selesai menambahkan atau menghapus semuanya, jadi periksa masalah terbuka dan tarik permintaan jika Anda memiliki pertanyaan atau masukan.&lt;/p&gt;&lt;p&gt;Sekarang mari kita gali dengan beberapa sorotan!&lt;/p&gt;&lt;h3&gt;Tampilan dan nuansa baru&lt;/h3&gt;&lt;p&gt;Kami telah membangun peningkatan pada beranda dokumen kami di v4.5.0 dengan tampilan dan nuansa yang diperbarui untuk dokumen kami lainnya. Laman dokumen kami tidak lagi lebar penuh untuk meningkatkan keterbacaan dan membuat situs kami terasa kurang seperti aplikasi dan lebih seperti konten. Selain itu, kami telah meningkatkan bilah sisi untuk menggunakan bagian yang dapat diperluas (diberdayakan oleh plugin Ciutkan kami sendiri) untuk navigasi yang lebih cepat.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://blog.getbootstrap.com/assets/img/2020/06/v5-home.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;&lt;p&gt;Kami juga memakai logo baru! Lebih lanjut tentang itu ketika v5 menjadi stabil, tetapi cukup untuk mengatakan bahwa kami ingin memberikan peningkatan kecil pada kotak yang bulat.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://blog.getbootstrap.com/assets/img/2020/06/v5-new-logo.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;&lt;p&gt;Terinspirasi oleh CSS yang menciptakan awal dari proyek ini, logo kami mewujudkan perasaan set aturan&mdash;gaya yang dibatasi oleh kurung kurawal. Kami menyukainya dan berpikir Anda juga akan menyukainya. Harapkan untuk melihatnya diluncurkan ke dokumentasi v4, blog kami, dan lebih banyak lagi dari waktu ke waktu saat kami terus menyempurnakan berbagai hal dan mengirimkan rilis baru.&lt;/p&gt;&lt;h3&gt;jQuery dan JavaScript&lt;/h3&gt;&lt;p&gt;jQuery membawa akses yang belum pernah terjadi sebelumnya ke perilaku JavaScript yang kompleks ke jutaan (miliar?) orang selama satu setengah dekade terakhir. Secara pribadi, saya selalu bersyukur atas pemberdayaan dan dukungan yang diberikan kepada saya untuk terus menulis kode front-end, mempelajari hal-hal baru, dan merangkul plugin dari komunitas. Mungkin yang paling penting, itu selamanya mengubah JavaScript itu sendiri, dan itu sendiri merupakan monumen kesuksesan jQuery. Terima kasih kepada setiap kontributor dan pengelola jQuery yang memungkinkan hal itu bagi orang-orang seperti saya.&lt;/p&gt;&lt;p&gt;Berkat kemajuan yang dibuat dalam alat pengembangan front-end dan dukungan browser, kami sekarang dapat menghapus jQuery sebagai ketergantungan, tetapi Anda tidak akan pernah menyadari sebaliknya. Migrasi ini merupakan upaya besar oleh @Johann-S, pengelola JavaScript utama kami hari ini. Ini menandai salah satu perubahan terbesar pada kerangka kerja dalam beberapa tahun dan berarti proyek yang dibangun di Bootstrap 5 akan secara signifikan lebih ringan pada ukuran file dan pemuatan halaman ke depan.&lt;/p&gt;&lt;p&gt;Selain menjatuhkan jQuery, kami telah membuat beberapa perubahan dan penyempurnaan lain pada JavaScript kami di v5 yang berfokus pada kualitas kode dan menjembatani kesenjangan antara v4 dan v5. Salah satu perubahan kami yang lebih besar lainnya adalah menjatuhkan sebagian besar plugin Tombol kami untuk pendekatan HTML dan CSS saja untuk beralih status. Sekarang tombol sakelar didukung oleh kotak centang dan tombol radio dan jauh lebih andal.&lt;/p&gt;&lt;p&gt;Anda dapat melihat daftar lengkap perubahan terkait JS dalam proyek alfa v5 pertama di GitHub.&lt;/p&gt;&lt;p&gt;Tertarik untuk membantu JavaScript Bootstrap? Kami selalu mencari kontributor baru untuk tim untuk membantu menulis plugin baru, meninjau permintaan tarik, dan memperbaiki bug. Beritahu kami!&lt;/p&gt;&lt;h3&gt;Properti khusus CSS&lt;/h3&gt;&lt;p&gt;Seperti yang disebutkan, kami telah mulai menggunakan properti kustom CSS di Bootstrap 5 berkat penurunan dukungan untuk Internet Explorer. Di v4 kami hanya menyertakan beberapa variabel root untuk warna dan font, dan sekarang kami telah menambahkannya untuk beberapa komponen dan opsi tata letak.&lt;/p&gt;&lt;p&gt;Ambil contoh komponen .table kami, di mana kami telah menambahkan beberapa variabel lokal untuk membuat gaya tabel bergaris, melayang, dan aktif lebih mudah:&lt;/p&gt;&lt;pre class=&quot;language-css&quot;&gt;&lt;code class=&quot;language-css&quot;&gt;.table {--bs-table-bg: #{&#36;table-bg};  --bs-table-accent-bg: transparent;  --bs-table-striped-color: #{&#36;table-striped-color};  --bs-table-striped-bg: #{&#36;table-striped-bg};  --bs-table-active-color: #{&#36;table-active-color};  --bs-table-active-bg: #{&#36;table-active-bg};  --bs-table-hover-color: #{&#36;table-hover-color};  --bs-table-hover-bg: #{&#36;table-hover-bg};  // Styles here...}&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;Kami sedang berupaya memanfaatkan kekuatan super dari properti kustom Sass dan CSS untuk sistem yang lebih fleksibel. Anda dapat membaca lebih lanjut tentang ini di halaman dokumen Tabel dan berharap untuk melihat lebih banyak penggunaan dalam komponen seperti tombol dalam waktu dekat.&lt;/p&gt;&lt;h3&gt;Dokumen penyesuaian yang ditingkatkan&lt;/h3&gt;&lt;p&gt;Kami telah berjongkok dan meningkatkan dokumentasi kami di beberapa tempat, memberikan lebih banyak penjelasan, menghilangkan ambiguitas, dan memberikan lebih banyak dukungan untuk memperluas Bootstrap. Semuanya dimulai dengan bagian Kustomisasi yang sama sekali baru.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://user-images.githubusercontent.com/98681/84740682-ac43c600-af62-11ea-88a4-79c1362061c8.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;&lt;p&gt;Dokumen Kustomisasi v5 diperluas di halaman Tema v4 dengan lebih banyak konten dan cuplikan kode untuk membangun di atas file Sass sumber Bootstrap. Kami telah menyempurnakan lebih banyak konten di sini dan bahkan menyediakan proyek npm pemula bagi Anda untuk memulai dengan lebih cepat dan lebih mudah. Ini juga tersedia sebagai repo template di GitHub, sehingga Anda dapat dengan bebas melakukan fork and go.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://user-images.githubusercontent.com/98681/84801339-e5585680-afb3-11ea-8743-29647ff3f3a9.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;&lt;p&gt;Kami juga telah memperluas palet warna kami di v5. Dengan sistem warna bawaan yang ekstensif, Anda dapat lebih mudah menyesuaikan tampilan dan nuansa aplikasi Anda tanpa harus meninggalkan basis kode. Kami juga telah melakukan beberapa pekerjaan untuk meningkatkan kontras warna, dan bahkan menyediakan metrik kontras warna di dokumen Warna kami. Mudah-mudahan, ini akan terus membantu membuat situs yang didukung Bootstrap lebih mudah diakses oleh orang-orang di seluruh dunia.&lt;/p&gt;&lt;h3&gt;Formulir yang diperbarui&lt;/h3&gt;&lt;p&gt;Selain bagian Kustomisasi yang baru, kami telah merombak dokumentasi dan komponen Formulir kami. Kami telah menggabungkan semua gaya formulir kami ke dalam bagian Formulir baru (termasuk komponen grup input) untuk memberi mereka penekanan yang pantas mereka dapatkan.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://blog.getbootstrap.com/assets/img/2020/06/v5-forms.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;&lt;p&gt;Di samping halaman dokumen baru, kami telah mendesain ulang dan menghapus semua kontrol formulir kami. Di v4 kami memperkenalkan rangkaian ekstensif kontrol formulir khusus&mdash;pemeriksaan, radio, sakelar, file, dan lainnya&mdash;tetapi itu adalah tambahan dari default apa pun yang disediakan setiap browser. Dengan v5, kami telah sepenuhnya menyesuaikan.&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://blog.getbootstrap.com/assets/img/2020/06/v5-checks.png&quot; style=&quot;width: 645px;&quot;&gt;Jika Anda terbiasa dengan markup formulir v4, ini seharusnya tidak terlihat terlalu jauh untuk Anda. Dengan satu set kontrol formulir dan fokus pada mendesain ulang elemen yang ada vs menghasilkan yang baru melalui elemen semu, kami memiliki tampilan dan nuansa yang jauh lebih konsisten.&lt;/p&gt;&lt;pre class=&quot;language-html&quot;&gt;&lt;code class=&quot;language-html&quot;&gt;&amp;lt;div class=&quot;form-check&quot;&amp;gt;  &amp;lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; value=&quot;&quot; id=&quot;flexCheckDefault&quot;&amp;gt;  &amp;lt;label class=&quot;form-check-label&quot; for=&quot;flexCheckDefault&quot;&amp;gt;    Default checkbox  &amp;lt;/label&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div class=&quot;form-check&quot;&amp;gt;  &amp;lt;input class=&quot;form-check-input&quot; type=&quot;radio&quot; name=&quot;flexRadioDefault&quot; id=&quot;flexRadioDefault1&quot;&amp;gt;  &amp;lt;label class=&quot;form-check-label&quot; for=&quot;flexRadioDefault1&quot;&amp;gt;    Default radio  &amp;lt;/label&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;div class=&quot;form-check form-switch&quot;&amp;gt;  &amp;lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;flexSwitchCheckDefault&quot;&amp;gt;  &amp;lt;label class=&quot;form-check-label&quot; for=&quot;flexSwitchCheckDefault&quot;&amp;gt;Default switch checkbox input&amp;lt;/label&amp;gt;&amp;lt;/div&amp;gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;Setiap kotak centang, radio, pilih, file, rentang, dan lainnya menyertakan tampilan khusus untuk menyatukan gaya dan perilaku kontrol formulir di seluruh OS dan browser. Kontrol formulir baru ini semuanya dibangun di atas kontrol formulir standar yang sepenuhnya semantik&mdash;tidak ada lagi markup yang berlebihan, cukup kontrol dan label formulir.&lt;/p&gt;&lt;p&gt;Pastikan untuk menjelajahi dokumen formulir baru dan beri tahu kami pendapat Anda.&lt;/p&gt;&lt;h3&gt;API Utilitas&lt;/h3&gt;&lt;p&gt;Kami senang melihat berapa banyak orang yang membuat library dan toolkit CSS baru dan menarik, menantang cara kami membangun di web selama lebih dari satu dekade terakhir. Ini menyegarkan, untuk sedikitnya, dan memberi kita semua kesempatan untuk berdiskusi dan mengulangi. Karena itu, kami telah menerapkan API utilitas baru ke dalam Bootstrap 5.&lt;/p&gt;&lt;pre class=&quot;language-sas&quot;&gt;&lt;code class=&quot;language-sas&quot;&gt;&#36;utilities: () !default;&#36;utilities: map-merge(  (    // ...    &quot;width&quot;: (      property: width,      class: w,      values: (        25: 25%,        50: 50%,        75: 75%,        100: 100%,        auto: auto      )    ),    // ...    &quot;margin&quot;: (      responsive: true,      property: margin,      class: m,      values: map-merge(&#36;spacers, (auto: auto))    ),    // ...  ), &#36;utilities);&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;Sejak utilitas menjadi cara yang disukai untuk membangun, kami telah bekerja untuk menemukan keseimbangan yang tepat untuk menerapkannya di Bootstrap sambil memberikan kontrol dan penyesuaian. Di v4, kami melakukan ini dengan kelas &#36;enable-* global, dan kami bahkan telah meneruskannya di v5. Tetapi dengan pendekatan berbasis API, kami telah membuat bahasa dan sintaks di Sass untuk membuat utilitas Anda sendiri dengan cepat sambil juga dapat memodifikasi atau menghapus yang kami sediakan. Ini semua berkat @MartijnCuppens, yang juga mengelola proyek RFS, dan bertanggung jawab atas PR awal dan perbaikan selanjutnya.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Kami pikir ini akan menjadi pengubah permainan bagi mereka yang membangun di Bootstrap melalui file sumber kami, dan jika Anda belum membangun proyek yang didukung Bootstrap seperti itu, pikiran Anda akan meledak.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Perhatian! Kami telah memindahkan beberapa utilitas v4 kami sebelumnya ke bagian Pembantu baru. Helper ini adalah potongan kode yang lebih panjang dari pasangan nilai properti Anda yang biasa untuk utilitas kami. Hanya cara kami mengatur ulang berbagai hal untuk penamaan yang lebih mudah dan dokumentasi yang lebih baik.&lt;/p&gt;&lt;h3&gt;Sistem jaringan yang ditingkatkan&lt;/h3&gt;&lt;p&gt;Secara desain Bootstrap 5 tidak sepenuhnya berangkat dari v4. Kami ingin semua orang dapat lebih mudah meningkatkan ke versi mendatang ini setelah mendengar tentang kesulitan dari jalur peningkatan v3 ke v4. Kami telah mempertahankan sebagian besar sistem build di tempatnya (minus jQuery) karena alasan ini, dan kami juga membangun sistem grid yang ada alih-alih menggantinya dengan sesuatu yang lebih baru dan lebih keren.&lt;/p&gt;&lt;p&gt;Berikut ini ikhtisar dari apa yang berubah di grid kami:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;/li&gt;&lt;li&gt;Kami telah menambahkan tingkat kisi baru! Sampaikan salam untuk xxl.&lt;/li&gt;&lt;li&gt;kelas .gutter telah diganti dengan utilitas .g*, seperti utilitas margin/padding kami. Kami juga telah menambahkan opsi ke spasi talang grid Anda yang cocok dengan utilitas spasi yang sudah Anda kenal.&lt;/li&gt;&lt;li&gt;Opsi tata letak formulir telah diganti dengan sistem kisi baru.&lt;/li&gt;&lt;li&gt;Kelas jarak vertikal telah ditambahkan.&lt;/li&gt;&lt;li&gt;Kolom tidak lagi diposisikan: relatif secara default.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Berikut adalah contoh singkat tentang cara menggunakan kelas talang grid baru:&lt;/p&gt;&lt;pre class=&quot;language-html&quot;&gt;&lt;code class=&quot;language-html&quot;&gt;&amp;lt;div class=&quot;row g-5&quot;&amp;gt;  &amp;lt;div class=&quot;col&quot;&amp;gt;...&amp;lt;/div&amp;gt;  &amp;lt;div class=&quot;col&quot;&amp;gt;...&amp;lt;/div&amp;gt;  &amp;lt;div class=&quot;col&quot;&amp;gt;...&amp;lt;/div&amp;gt;&amp;lt;/div&amp;gt;&lt;/code&gt;&lt;/pre&gt;&lt;p&gt;Lihat dokumen Tata Letak yang didesain ulang dan direstrukturisasi untuk mempelajari lebih lanjut.&lt;/p&gt;&lt;p&gt;Tata letak grid CSS semakin siap untuk prime time, dan sementara kami belum menggunakannya di sini, kami terus bereksperimen dan belajar darinya. Nantikan rilis v5 di masa mendatang untuk merangkulnya dengan lebih banyak cara.&lt;/p&gt;&lt;h3&gt;Dokumen&lt;/h3&gt;&lt;p&gt;Kami mengganti generator situs statis dokumentasi kami dari Jekyll ke Hugo. Jekyll telah lama menjadi generator pilihan kami mengingat betapa mudahnya untuk memulai dan menjalankannya, dan kesederhanaannya dengan penerapan ke GitHub Pages.&lt;/p&gt;&lt;p&gt;Sayangnya, kami telah mencapai dua masalah utama dengan Jekyll selama bertahun-tahun:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;/li&gt;&lt;li&gt;Jekyll membutuhkan Ruby untuk diinstal&lt;/li&gt;&lt;li&gt;Pembuatan situs sangat lambat&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Hugo di sisi lain ditulis dalam Go, sehingga tidak memiliki ketergantungan runtime eksternal, dan jauh lebih cepat. Kami membangun situs cabang master kami saat ini, termasuk Sass dokumen -&amp;gt; CSS dalam ~1.6s. Server lokal kami memuat ulang dalam milidetik, bukan 8-12 detik, jadi mengerjakan dokumen telah menjadi pengalaman yang menyenangkan lagi.&lt;/p&gt;&lt;p&gt;Hugo di sisi lain ditulis dalam Go, sehingga tidak memiliki ketergantungan runtime eksternal, dan jauh lebih cepat. Kami membangun situs cabang master kami saat ini, termasuk Sass dokumen -&amp;gt; CSS dalam ~1.6s. Server lokal kami memuat ulang dalam milidetik, bukan 8-12 detik, jadi mengerjakan dokumen telah menjadi pengalaman yang menyenangkan lagi.&lt;/p&gt;&lt;p&gt;Juga teriakan kepada @xhmikosr yang memimpin tugas di sini dalam mengonversi ratusan file dan bekerja dengan pengembang Hugo untuk memastikan pengembangan lokal kami cepat, efisien, dan dapat dipelihara.&lt;/p&gt;&lt;h3&gt;Segera hadir: RTL, offcanvas, dan banyak lagi&lt;/h3&gt;&lt;p&gt;Ada banyak hal yang tidak sempat kami tangani di alfa pertama kami yang masih ada dalam daftar tugas untuk alfa masa depan. Kami ingin memberi mereka cinta di sini sehingga Anda tahu apa yang ada di radar kami selama pengembangan v5.&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;/li&gt;&lt;li&gt;RTL datang! Kami telah meningkatkan PR menggunakan RTLCSS dan terus mengeksplorasi properti logis juga. Secara pribadi, saya minta maaf karena membutuhkan waktu lama bagi kami untuk secara resmi menangani ini mengetahui semua upaya yang dilakukan untuk upaya komunitas dan menarik permintaan ke proyek. Semoga penantian itu sepadan.&lt;/li&gt;&lt;li&gt;Ada versi bercabang dari modal kami yang menerapkan menu offcanvas. Kami masih memiliki beberapa pekerjaan yang harus dilakukan di sini untuk melakukannya dengan benar tanpa menambahkan terlalu banyak overhead, tetapi gagasan memiliki pembungkus offcanvas untuk menempatkan konten bernilai bilah sisi &mdash; navigasi, keranjang belanja, dll &mdash; sangat besar. Secara pribadi, saya tahu kita ketinggalan zaman dalam hal ini, tetapi tetap saja itu harus luar biasa.&lt;/li&gt;&lt;li&gt;Kami sedang mengevaluasi sejumlah perubahan lain pada basis kode kami, termasuk sistem modul Sass, peningkatan penggunaan properti kustom CSS, penyematan SVG dalam HTML kami, bukan CSS kami, dan banyak lagi.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Masih banyak yang akan datang, termasuk lebih banyak peningkatan dokumentasi, perbaikan bug, dan perubahan kualitas hidup. Pastikan untuk meninjau masalah terbuka dan PR kami untuk melihat di mana Anda dapat membantu dengan memberikan umpan balik, menguji PR komunitas, atau membagikan ide Anda.&lt;/p&gt;&lt;h3&gt;Memulai&lt;/h3&gt;&lt;p&gt;Buka https://v5.getbootstrap.com untuk menjelajahi rilis baru. Kami juga telah memublikasikan pembaruan ini sebagai pra-rilis ke npm, jadi jika Anda merasa berani atau ingin tahu tentang apa yang baru, Anda dapat menarik yang terbaru dengan cara itu.&lt;/p&gt;&lt;p&gt;npm i bootstrap@next&lt;/p&gt;&lt;h3&gt;Apa berikutnya&lt;/h3&gt;&lt;p&gt;Kami masih memiliki lebih banyak pekerjaan yang harus dilakukan di v5, termasuk beberapa perubahan penting, tetapi kami sangat senang dengan rilis ini. Biarkan umpan balik merobek dan kami akan melakukan yang terbaik untuk mengikuti Anda semua. Tujuan kami adalah mengirimkan alfa lain dalam waktu 3-4 minggu, dan kemungkinan beberapa lagi setelah itu. Kami juga akan mengirimkan rilis v4.5.1 untuk memperbaiki beberapa regresi dan terus menjembatani kesenjangan antara v4 dan v5.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Selain itu, perhatikan lebih banyak pembaruan untuk proyek Ikon Bootstrap, proyek RFS kami (sekarang diaktifkan secara default di v5), dan proyek pemula npm.&lt;/span&gt;&lt;/p&gt;&lt;h3&gt;Dukung tim&lt;/h3&gt;&lt;p&gt;Kunjungi halaman Kolektif Terbuka kami atau profil GitHub anggota tim kami untuk membantu mendukung pengelola yang berkontribusi pada Bootstrap.&lt;/p&gt;&lt;p&gt;&amp;lt;3,&lt;/p&gt;&lt;p&gt;@mdo &amp;amp; team&lt;/p&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "post",
            "post_image" => "image25.jpg",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:08",
            "updated_at" => "2022-06-12 00:00:08"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('id', 'Teknologi'),
            $this->getTagIdByLanguageCode('id', 'Framework'),
            $this->getTagIdByLanguageCode('id', 'Bootstrap'),
            $this->getTagIdByLanguageCode('id', 'HTML'),
            $this->getTagIdByLanguageCode('id', 'CSS')
        ]);
        $post->translations()->attach(9);

        # 27

        $post = Post::create([
            "id" => 27,
            "post_title" => "تم إطلاق Bootstrap 5 Alpha أخيرًا!",
            "post_name" => "tm-tl-k-bootstrap-5-alpha-akhyr",
            "post_summary" => html_entity_decode("&lt;p&gt;&#x648;&#x635;&#x644; &#x623;&#x648;&#x644; &#x625;&#x635;&#x62F;&#x627;&#x631; &#x623;&#x644;&#x641;&#x627; &#x645;&#x646; Bootstrap 5! &#x644;&#x642;&#x62F; &#x639;&#x645;&#x644;&#x646;&#x627; &#x628;&#x62C;&#x62F; &#x644;&#x639;&#x62F;&#x629; &#x623;&#x634;&#x647;&#x631; &#x644;&#x62A;&#x62D;&#x633;&#x64A;&#x646; &#x627;&#x644;&#x639;&#x645;&#x644; &#x627;&#x644;&#x630;&#x64A; &#x628;&#x62F;&#x623;&#x646;&#x627;&#x647; &#x641;&#x64A; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; 4 &#x60C; &#x648;&#x628;&#x64A;&#x646;&#x645;&#x627; &#x646;&#x634;&#x639;&#x631; &#x628;&#x627;&#x644;&#x631;&#x636;&#x627; &#x62D;&#x64A;&#x627;&#x644; &#x62A;&#x642;&#x62F;&#x645;&#x646;&#x627; &#x60C; &#x644;&#x627; &#x64A;&#x632;&#x627;&#x644; &#x647;&#x646;&#x627;&#x643; &#x627;&#x644;&#x645;&#x632;&#x64A;&#x62F; &#x644;&#x644;&#x642;&#x64A;&#x627;&#x645; &#x628;&#x647;.&lt;/p&gt;"),
            "post_content" => html_entity_decode("&lt;p&gt;&#x644;&#x642;&#x62F; &#x631;&#x643;&#x632;&#x646;&#x627; &#x639;&#x644;&#x649; &#x62C;&#x639;&#x644; &#x627;&#x644;&#x62A;&#x631;&#x62D;&#x64A;&#x644; &#x645;&#x646; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; 4 &#x625;&#x644;&#x649; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; 5 &#x623;&#x643;&#x62B;&#x631; &#x633;&#x647;&#x648;&#x644;&#x629; &#x60C; &#x648;&#x644;&#x643;&#x646;&#x646;&#x627; &#x644;&#x645; &#x646;&#x62E;&#x627;&#x641; &#x623;&#x64A;&#x636;&#x64B;&#x627; &#x645;&#x646; &#x627;&#x644;&#x627;&#x628;&#x62A;&#x639;&#x627;&#x62F; &#x639;&#x645;&#x627; &#x639;&#x641;&#x627; &#x639;&#x644;&#x64A;&#x647; &#x627;&#x644;&#x632;&#x645;&#x646; &#x623;&#x648; &#x644;&#x645; &#x64A;&#x639;&#x62F; &#x645;&#x646;&#x627;&#x633;&#x628;&#x64B;&#x627;. &#x639;&#x644;&#x649; &#x647;&#x630;&#x627; &#x627;&#x644;&#x646;&#x62D;&#x648; &#x60C; &#x64A;&#x633;&#x639;&#x62F;&#x646;&#x627; &#x62C;&#x62F;&#x64B;&#x627; &#x623;&#x646; &#x646;&#x642;&#x648;&#x644; &#x625;&#x646;&#x647; &#x645;&#x639; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; 5 &#x60C; &#x644;&#x645; &#x64A;&#x639;&#x62F; Bootstrap &#x64A;&#x639;&#x62A;&#x645;&#x62F; &#x639;&#x644;&#x649; jQuery &#x648;&#x642;&#x62F; &#x623;&#x633;&#x642;&#x637;&#x646;&#x627; &#x62F;&#x639;&#x645; Internet Explorer. &#x646;&#x62D;&#x646; &#x646;&#x639;&#x645;&#x644; &#x639;&#x644;&#x649; &#x632;&#x64A;&#x627;&#x62F;&#x629; &#x62A;&#x631;&#x643;&#x64A;&#x632;&#x646;&#x627; &#x639;&#x644;&#x649; &#x628;&#x646;&#x627;&#x621; &#x623;&#x62F;&#x648;&#x627;&#x62A; &#x623;&#x643;&#x62B;&#x631; &#x645;&#x644;&#x627;&#x621;&#x645;&#x629; &#x644;&#x644;&#x645;&#x633;&#x62A;&#x642;&#x628;&#x644; &#x60C; &#x648;&#x639;&#x644;&#x649; &#x627;&#x644;&#x631;&#x63A;&#x645; &#x645;&#x646; &#x623;&#x646;&#x646;&#x627; &#x644;&#x645; &#x646;&#x635;&#x644; &#x625;&#x644;&#x649; &#x647;&#x646;&#x627;&#x643; &#x628;&#x627;&#x644;&#x643;&#x627;&#x645;&#x644; &#x628;&#x639;&#x62F; &#x60C; &#x641;&#x625;&#x646; &#x627;&#x644;&#x648;&#x639;&#x62F; &#x628;&#x62A;&#x642;&#x62F;&#x64A;&#x645; &#x645;&#x62A;&#x63A;&#x64A;&#x631;&#x627;&#x62A; CSS &#x648;&#x62C;&#x627;&#x641;&#x627; &#x633;&#x643;&#x631;&#x64A;&#x628;&#x62A; &#x623;&#x633;&#x631;&#x639; &#x648;&#x62A;&#x628;&#x639;&#x64A;&#x627;&#x62A; &#x623;&#x642;&#x644; &#x648;&#x648;&#x627;&#x62C;&#x647;&#x627;&#x62A; &#x628;&#x631;&#x645;&#x62C;&#x629; &#x62A;&#x637;&#x628;&#x64A;&#x642;&#x627;&#x62A; &#x623;&#x641;&#x636;&#x644; &#x62A;&#x628;&#x62F;&#x648; &#x645;&#x646;&#x627;&#x633;&#x628;&#x629; &#x644;&#x646;&#x627; &#x628;&#x627;&#x644;&#x62A;&#x623;&#x643;&#x64A;&#x62F;.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&#x642;&#x628;&#x644; &#x623;&#x646; &#x62A;&#x642;&#x641;&#x632; &#x625;&#x644;&#x649; &#x627;&#x644;&#x62A;&#x62D;&#x62F;&#x64A;&#x62B; &#x60C; &#x64A;&#x631;&#x62C;&#x649; &#x62A;&#x630;&#x643;&#x631; &#x623;&#x646; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; 5 &#x647;&#x648; &#x627;&#x644;&#x622;&#x646; &#x641;&#x64A; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; &#x627;&#x644;&#x623;&#x648;&#x644;&#x64A; - &#x633;&#x64A;&#x633;&#x62A;&#x645;&#x631; &#x62D;&#x62F;&#x648;&#x62B; &#x627;&#x644;&#x62A;&#x63A;&#x64A;&#x64A;&#x631;&#x627;&#x62A; &#x62D;&#x62A;&#x649; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; &#x627;&#x644;&#x62A;&#x62C;&#x631;&#x64A;&#x628;&#x64A; &#x627;&#x644;&#x623;&#x648;&#x644;. &#x644;&#x645; &#x646;&#x646;&#x62A;&#x647;&#x64A; &#x645;&#x646; &#x625;&#x636;&#x627;&#x641;&#x629; &#x623;&#x648; &#x625;&#x632;&#x627;&#x644;&#x629; &#x643;&#x644; &#x634;&#x64A;&#x621; &#x60C; &#x644;&#x630;&#x627; &#x62A;&#x62D;&#x642;&#x642; &#x645;&#x646; &#x627;&#x644;&#x645;&#x634;&#x643;&#x644;&#x627;&#x62A; &#x627;&#x644;&#x645;&#x641;&#x62A;&#x648;&#x62D;&#x629; &#x648;&#x627;&#x633;&#x62D;&#x628; &#x627;&#x644;&#x637;&#x644;&#x628;&#x627;&#x62A; &#x644;&#x623;&#x646; &#x644;&#x62F;&#x64A;&#x643; &#x623;&#x633;&#x626;&#x644;&#x629; &#x623;&#x648; &#x62A;&#x639;&#x644;&#x64A;&#x642;&#x627;&#x62A;.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&#x627;&#x644;&#x622;&#x646; &#x62F;&#x639;&#x648;&#x646;&#x627; &#x646;&#x62A;&#x639;&#x645;&#x642; &#x645;&#x639; &#x628;&#x639;&#x636; &#x627;&#x644;&#x646;&#x642;&#x627;&#x637; &#x627;&#x644;&#x628;&#x627;&#x631;&#x632;&#x629;!&lt;/span&gt;&lt;/p&gt;&lt;h3&gt;&#x634;&#x643;&#x644; &#x648;&#x645;&#x638;&#x647;&#x631; &#x62C;&#x62F;&#x64A;&#x62F;&#x627;&#x646;&lt;/h3&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&#x644;&#x642;&#x62F; &#x642;&#x645;&#x646;&#x627; &#x628;&#x628;&#x646;&#x627;&#x621; &#x627;&#x644;&#x62A;&#x62D;&#x633;&#x64A;&#x646;&#x627;&#x62A; &#x627;&#x644;&#x62A;&#x64A; &#x62A;&#x645; &#x625;&#x62C;&#x631;&#x627;&#x624;&#x647;&#x627; &#x639;&#x644;&#x649; &#x627;&#x644;&#x635;&#x641;&#x62D;&#x629; &#x627;&#x644;&#x631;&#x626;&#x64A;&#x633;&#x64A;&#x629; &#x644;&#x644;&#x645;&#x633;&#x62A;&#x646;&#x62F;&#x627;&#x62A; &#x641;&#x64A; &#x627;&#x644;&#x625;&#x635;&#x62F;&#x627;&#x631; v4.5.0 &#x645;&#x639; &#x645;&#x638;&#x647;&#x631; &#x648;&#x623;&#x633;&#x644;&#x648;&#x628; &#x645;&#x62D;&#x62F;&#x62B;&#x64A;&#x646; &#x644;&#x628;&#x642;&#x64A;&#x629; &#x645;&#x633;&#x62A;&#x646;&#x62F;&#x627;&#x62A;&#x646;&#x627;. &#x644;&#x645; &#x62A;&#x639;&#x62F; &#x635;&#x641;&#x62D;&#x627;&#x62A; &#x645;&#x633;&#x62A;&#x646;&#x62F;&#x627;&#x62A;&#x646;&#x627; &#x643;&#x627;&#x645;&#x644;&#x629; &#x627;&#x644;&#x639;&#x631;&#x636; &#x644;&#x62A;&#x62D;&#x633;&#x64A;&#x646; &#x642;&#x627;&#x628;&#x644;&#x64A;&#x629; &#x627;&#x644;&#x642;&#x631;&#x627;&#x621;&#x629; &#x648;&#x62C;&#x639;&#x644; &#x645;&#x648;&#x642;&#x639;&#x646;&#x627; &#x64A;&#x628;&#x62F;&#x648; &#x623;&#x642;&#x644; &#x62A;&#x634;&#x627;&#x628;&#x647;&#x64B;&#x627; &#x645;&#x639; &#x627;&#x644;&#x62A;&#x637;&#x628;&#x64A;&#x642;&#x627;&#x62A; &#x648;&#x623;&#x643;&#x62B;&#x631; &#x62A;&#x634;&#x627;&#x628;&#x647;&#x64B;&#x627; &#x645;&#x639; &#x627;&#x644;&#x645;&#x62D;&#x62A;&#x648;&#x649;. &#x628;&#x627;&#x644;&#x625;&#x636;&#x627;&#x641;&#x629; &#x625;&#x644;&#x649; &#x630;&#x644;&#x643; &#x60C; &#x642;&#x645;&#x646;&#x627; &#x628;&#x62A;&#x631;&#x642;&#x64A;&#x629; &#x627;&#x644;&#x634;&#x631;&#x64A;&#x637; &#x627;&#x644;&#x62C;&#x627;&#x646;&#x628;&#x64A; &#x644;&#x62F;&#x64A;&#x646;&#x627; &#x644;&#x627;&#x633;&#x62A;&#x62E;&#x62F;&#x627;&#x645; &#x623;&#x642;&#x633;&#x627;&#x645; &#x642;&#x627;&#x628;&#x644;&#x629; &#x644;&#x644;&#x62A;&#x648;&#x633;&#x64A;&#x639; (&#x645;&#x62F;&#x639;&#x648;&#x645;&#x629; &#x645;&#x646; &#x62E;&#x644;&#x627;&#x644; &#x627;&#x644;&#x645;&#x643;&#x648;&#x651;&#x646; &#x627;&#x644;&#x625;&#x636;&#x627;&#x641;&#x64A; Collapse &#x627;&#x644;&#x62E;&#x627;&#x635; &#x628;&#x646;&#x627;) &#x644;&#x644;&#x62A;&#x646;&#x642;&#x644; &#x628;&#x634;&#x643;&#x644; &#x623;&#x633;&#x631;&#x639;.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;https://blog.getbootstrap.com/assets/img/2020/06/v5-home.png&quot; style=&quot;width: 645px;&quot;&gt;&lt;/p&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "post",
            "post_image" => "image25.jpg",
            "post_hits" => 5,
            "like" => 5,
            "created_at" => "2022-06-12 00:00:09",
            "updated_at" => "2022-06-12 00:00:09"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('ar', 'تقنية'),
            $this->getTagIdByLanguageCode('ar', 'إطار العمل'),
            $this->getTagIdByLanguageCode('ar', 'التمهيد'),
            $this->getTagIdByLanguageCode('ar', 'لغة البرمجة'),
            $this->getTagIdByLanguageCode('ar', 'المغلق')
        ]);
        $post->translations()->sync([9]);

        # Post Translation Relations 10

        Translation::create([
            'id' => 10,
            'value' => json_encode([
                'en' => 28,
            ])
        ]);

        # 28

        $post = Post::create([
            "id" => 28,
            "post_title" => "Stylish Getaways In Kintamani, Bali For Your Next Holiday",
            "post_name" => "stylish-getaways-in-kintamani-bali-for-your-next-holiday",
            "post_summary" => "<p>Stylish getaways in Kintamani, Bali for your next holiday</p>",
            "post_content" => html_entity_decode("&lt;p&gt;Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Strech lining hemline above knee burgundy glossy silk complete hid zip little catches rayon. Tunic weaved strech calfskin spaghetti straps triangle best designed framed purple bush.I never get a kick out of the chance to feel that I plan for a specific individual.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;h5&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Decide what to blog&lt;/span&gt;&lt;/h5&gt;&lt;p&gt;On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &ldquo;and&rdquo; and the Little Blind Text should turn around and return to its own, safe country.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;But nothing the copy said could convince her and so it didn&rsquo;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn&rsquo;t been rewritten, then they are still using her.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;h5&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Pick A Good Theme&lt;/span&gt;&lt;/h5&gt;&lt;p&gt;JNews is a theme designed to provide an &ldquo;all-in-one&rdquo; solution for every publishing need. With JNews, you can explore endless possibilities in crafting the best fully-functional website. We provide 140+ homepage that perfect for your News site, Magazine site, Blog site, Editorial site and for all kind of publishing website. Also provided automatic import feature to replicate one of the demos you like just by one click.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Customizing your website with JNews is easy &amp;amp; fun. You can lively see the change you made and create a landing page with ease by utilizing Drag and Drop Header Builder, WPBakery Visual Composer &amp;amp; Customizer. We fully integrate all elements of WPBakery Visual Composer, including FrontEnd Visual Composer Editor.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;&lt;b&gt;The most complete solution for web publishing&lt;/b&gt;&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Responsive Design. Tested on Google Mobile Friendly&lt;/span&gt;&lt;/li&gt;&lt;li&gt;Header Builder with Live Preview&lt;/li&gt;&lt;li&gt;Optimized for Google Page Speed as SEO Signal&lt;/li&gt;&lt;li&gt;Website schema using JSON LD which is recommended by Google&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;A collection of textile samples lay spread out on the table &ndash; Samsa was a travelling salesman &ndash; and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table &ndash; Samsa was a travelling salesman &ndash; and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image28.jpg",
            "meta_description" => "Stylish getaways in Kintamani, Bali for your next holiday",
            "meta_keyword" => "holiday,bali,indonesia",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:09",
            "updated_at" => "2022-06-12 00:00:09"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Holiday'),
            $this->getTagIdByLanguageCode('en', 'Indonesia')
        ]);
        $post->translations()->attach(10);

        # Post Translation Relations 11

        Translation::create([
            'id' => 11,
            'value' => json_encode([
                'en' => 29,
            ])
        ]);

        # 29

        $post = Post::create([
            "id" => 29,
            "post_title" => "Is Japan The Most Overrated Travel Destination In The World?",
            "post_name" => "is-japan-the-most-overrated-travel-destination-in-the-world",
            "post_content" => html_entity_decode("&lt;p&gt;Intro text we refine our methods of responsive web design, we&apos;ve increasingly focused on measure and its relationship to how people read.&lt;/p&gt;
            &lt;p&gt;A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. Even the all-powerful Pointing has no control about the blind texts it is an almost &lt;a href=&quot;https://epic.jegtheme.com/is-japan-the-most-overrated-travel-destination-in-the-world/#&quot; style=&quot;text-decoration:none;&quot;&gt;unorthographic&lt;/a&gt; life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&apos;t listen.&lt;/p&gt;
            &lt;p&gt;On the topic of alignment, it should be noted that users can choose from the options of None, Left, Right, and Center. In addition, they also get the options of Thumbnail, Medium, Large &amp;amp; Fullsize.&lt;/p&gt;
            &lt;p&gt;And if she hasn&apos;t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.&lt;/p&gt;
            &lt;p&gt;&lt;img src=&quot;../../../../storage/images/image28.jpg&quot;&gt;&lt;br&gt;&lt;/p&gt;
            &lt;blockquote class=&quot;blockquote&quot;&gt;
            &lt;p&gt;A wonderful serenity has taken possession of my entire soul&lt;/p&gt;
            &lt;/blockquote&gt;
            &lt;p&gt;On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &ldquo;and&rdquo; and the Little Blind Text should turn around and return to its own, safe country.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&lt;/p&gt;
            &lt;p&gt;But nothing the copy said could convince her and so it didn&apos;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.&lt;/p&gt;
            &lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&lt;/p&gt;
            &lt;br&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image29.jpg",
            "meta_description" => "Vinales will be as tough for Rossi as Lorenzo – Suzuki MotoGP boss",
            "meta_keyword" => "Japan, Holiday",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:10",
            "updated_at" => "2022-06-12 00:00:10"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Holiday'),
            $this->getTagIdByLanguageCode('en', 'Japan')
        ]);
        $post->translations()->attach(11);

        # Post Translation Relations 12

        Translation::create([
            'id' => 12,
            'value' => json_encode([
                'en' => 30,
            ])
        ]);

        # 30

        $post = Post::create([
            "id" => 30,
            "post_title" => "Vinales Will Be As Tough For Rossi As Lorenzo – Suzuki Motogp Boss",
            "post_name" => "vinales-will-be-as-tough-for-rossi-as-lorenzo-suzuki-motogp-boss",
            "post_content" => html_entity_decode("&lt;p&gt;Intro text we refine our methods of responsive web design, we&apos;ve increasingly focused on measure and its relationship to how people read.&lt;/p&gt;
            &lt;p&gt;A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. Even the all-powerful Pointing has no control about the blind texts it is an almost &lt;a href=&quot;https://epic.jegtheme.com/vinales-will-be-as-tough-for-rossi-as-lorenzo-suzuki-motogp-boss/#&quot; style=&quot;text-decoration:none;&quot;&gt;unorthographic&lt;/a&gt; life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&apos;t listen.&lt;/p&gt;
            &lt;p&gt;On the topic of alignment, it should be noted that users can choose from the options of None, Left, Right, and Center. In addition, they also get the options of Thumbnail, Medium, Large &amp;amp; Fullsize.&lt;/p&gt;
            &lt;p&gt;And if she hasn&apos;t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.&lt;/p&gt;
            &lt;blockquote class=&quot;blockquote&quot;&gt;
            &lt;p&gt;A wonderful serenity has taken possession of my entire soul&lt;/p&gt;
            &lt;/blockquote&gt;
            &lt;p&gt;On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &ldquo;and&rdquo; and the Little Blind Text should turn around and return to its own, safe country.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.&lt;/p&gt;
            &lt;p&gt;But nothing the copy said could convince her and so it didn&apos;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.&lt;/p&gt;
            &lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image30.jpg",
            "meta_description" => "Vinales will be as tough for Rossi as Lorenzo – Suzuki MotoGP boss",
            "meta_keyword" => "Sport, MotoGP,racing",
            "post_hits" => 2,
            "like" => 2,
            "created_at" => "2022-06-12 00:00:11",
            "updated_at" => "2022-06-12 00:00:11"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'MotoGP')
        ]);
        $post->translations()->attach(12);

        # Post Translation Relations 13

        Translation::create([
            'id' => 13,
            'value' => json_encode([
                'en' => 31,
            ])
        ]);

        # 31

        $post = Post::create([
            "id" => 31,
            "post_title" => "Google Meet Adding Support For Anonymous Questions And Poll Responses",
            "post_name" => "google-meet-adding-support-for-anonymous-questions-and-poll-responses",
            "post_content" => html_entity_decode("&lt;p&gt;With the Duo migration underway, Google continues to add more enterprise-focused features to Meet. The latest lets Google Meet participants ask questions and answer polls anonymously.When a user responds to a Poll anonymously or posts a question anonymously, the details are kept anonymous to other participants, the meeting hosts, and your Google Workspace Admin. Note that Google retains your poll response and anonymous questions. This data is later anonymized or deleted.&lt;/p&gt;&lt;p&gt;According to Google, this has been a top request and geared towards large calls. It&apos;s meant to &ldquo;encourage greater participation from meeting attendees who would prefer to not be identified by name.&quot; It&apos;s also ideal for public meetings to protect privacy.&lt;/p&gt;&lt;p&gt;Anonymous questions are allowed by default and can be disabled by meeting hosts from Meeting Activities &amp;gt; Allow Questions in Q&amp;amp;A &amp;gt; Allow Anonymous questions. Meanwhile, anonymous polls are disabled by default but are a toggle switch away during the creation process.&lt;/p&gt;&lt;p&gt;These settings reset every meeting. Anonymous questions and polls in Google Meet are rolling out now and will be widely launched in the coming weeks. Availability is as follows:&lt;/p&gt;&lt;h3&gt;Q &amp;amp; As&lt;/h3&gt;&lt;p&gt;Available to Google Workspace Essentials, Business Standard, Business Plus, Enterprise Starter, Enterprise Essentials, Enterprise Standard, Enterprise Plus, Teaching and Learning Upgrade, Education Plus and Nonprofits, as well as legacy G Suite Business customersNot available to Google Workspace Business Starter, Education Fundamentals, Education Standard, Frontline customers, or legacy G Suite Basic customers&lt;/p&gt;&lt;h3&gt;Polls&lt;/h3&gt;&lt;p&gt;Available to Google Workspace Essentials, Business Standard, Business Plus, Enterprise Starter, Enterprise Essentials, Enterprise Standard, Enterprise Plus, Teaching and Learning Upgrade, Education Plus and Nonprofits, as well as legacy G Suite Business customers.&lt;/p&gt;&lt;p&gt;Also available to Google Workspace Individual usersNot available to Google Workspace Business Starter, Education Fundamentals, Education Standard, Frontline customers, or legacy G Suite Basic customers&lt;/p&gt;&lt;p&gt;Source: &lt;a href=&quot;https://dream-space-the-news.blogspot.com/2022/07/google-meet-adding-support-for.html#&quot;&gt;https://9to5google.com&lt;/a&gt;&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image31.jpg",
            "post_hits" => 3,
            "like" => 3,
            "created_at" => "2022-10-17 07:59:47",
            "updated_at" => "2022-10-17 07:59:47"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Google'),
        ]);
        $post->translations()->attach(13);

        # Post Translation Relations 14

        Translation::create([
            'id' => 14,
            'value' => json_encode([
                'en' => 32,
            ])
        ]);

        # 32

        $post = Post::create([
            "id" => 32,
            "post_title" => "How To Make Alexa Your Preferred Hands-Free Voice Assistant On Your Android Phone",
            "post_name" => "how-to-make-alexa-your-preferred-hands-free-voice-assistant-on-your-android-phone",
            "post_content" => html_entity_decode("&lt;p&gt;As an Android phone user, it&apos;s almost second nature to go right to using Google Assistant. That&apos;s because Google has gone to great lengths to make its digital assistant so helpful that we love using it. But what if you use Alexa on all your smart speakers and would like to use it on your phone too? You&apos;re in luck. We can help you talk to Alexa hands-free on your phone.How to use Alexa, hands-free, on your Android phoneWhile Google Assistant is generally the default option on all of the best Android smartphones, it isn&apos;t the only voice assistant on the market. Many of the top smart speakers use Amazon&apos;s Alexa to help you out. But before we do that, ensure you have downloaded and set up the Alexa app on your phone if you haven&apos;t already. Here&apos;s how you can use that familiar helper on your phone too.1. Swipe down twice, or once with two fingers, on the notification bar of your Android smartphone and tap on the gear icon&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;&quot;../../../../storage/images/image58.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;After selecting Amazon Alexa, you will see a pop-up saying, &quot;The assistant will be able to read your information about apps in use on your system, including information visible on your screen or accessible within the apps.&quot; If you are willing to allow Alexa to have that kind of access, then tap on OK. Alexa can now be with you everywhere you go. Google Assistant is a really great digital assistant, and so is Alexa. Whether your home is full of Echo Dots, the massive Echo Show 15, Fire TV, or other excellent Alexa devices, having the voice assistant you are most familiar with accessible hands-free on your phone just makes sense. Now the next time you need to add something to your Amazon Shopping list, you can just ask your phone. &copy; Provided by Android Central Samsung Galaxy S22 Finding Alexa in the Galaxy The Samsung Galaxy S22 is a fantastic smartphone for many reasons from the cameras to the impressive performance. While it may have Google Assistant and Bixby onboard, Alexa is more than ready to take their place.&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "meta_description" => 'How to make Alexa your preferred hands-free voice assistant on your Android phone',
            "post_image" => "image32.jpg",
            "post_hits" => 2,
            "like" => 1,
            "created_at" => "2022-10-29 09:56:54",
            "updated_at" => "2022-10-29 09:56:54"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Android'),
        ]);
        $post->translations()->attach(14);


        # Post Translation Relations 15

        Translation::create([
            'id' => 15,
            'value' => json_encode([
                'en' => 33,
            ])
        ]);

        # 33

        $post = Post::create([
            "id" => 33,
            "post_title" => "Tiktok Has Been Accused Of ‘Aggressive’ Data Harvesting. Is Your Information At Risk?",
            "post_name" => "tiktok-has-been-accused-of-aggressive-data-harvesting-is-your-information-at-risk",
            "post_summary" => "<p>Cybersecurity experts have warned Australian TikTok users that the Chinese government could use the app to harvest personal information, from in-app messages with friends to precise device locations.</p>",
            "post_content" => html_entity_decode("&lt;p&gt;The warnings follow a report by Australian-US cybersecurity firm Internet 2.0, which found the most popular social media app of the year collects &amp;ldquo;excessive&amp;rdquo; amounts of information from its users.&lt;/p&gt;&lt;p&gt;Here&amp;rsquo;s what you need to know about TikTok&amp;rsquo;s data harvesting, and how to keep your information safe.&lt;/p&gt;&lt;h3&gt;What&amp;rsquo;s different about the way TikTok collects data?&lt;/h3&gt;&lt;p&gt;TikTok&amp;rsquo;s data collection methods include the ability to collect user contact lists, access calendars, scan hard drives including external ones and geolocate devices on an hourly basis.&lt;/p&gt;&lt;p&gt;&amp;ldquo;When the app is in use, it has significantly more permissions than it really needs,&amp;rdquo; said Robert Potter, co-CEO of Internet 2.0 and one of the editors of the report.&lt;/p&gt;&lt;p&gt;&amp;ldquo;It grants those permissions by default. When a user doesn&amp;rsquo;t give it permission &amp;hellip; [TikTok] persistently asks.&lt;/p&gt;&lt;p&gt;&amp;ldquo;If you tell Facebook you don&amp;rsquo;t want to share something, it won&amp;rsquo;t ask you again. TikTok is much more aggressive.&amp;rdquo;&lt;/p&gt;&lt;p&gt;The report labelled the app&amp;rsquo;s data collection practices &amp;ldquo;overly intrusive&amp;rdquo; and questioned their purpose.&lt;/p&gt;&lt;p&gt;&amp;ldquo;The application can and will run successfully without any of this data being gathered. This leads us to believe that the only reason this information has been gathered is for data harvesting,&amp;rdquo; it concluded.&lt;/p&gt;&lt;p&gt;Most of the concern in the report focuses on permissions sought on Android devices, because Apple&amp;rsquo;s iOS significantly limits what information an app can gather. It has a justification system so that if a developer wants access to something it must justify why this is required before it is granted.&lt;/p&gt;&lt;p&gt;&amp;ldquo;We believe the justification system iOS implements systematically limits a culture of &amp;lsquo;grab what you can&amp;rsquo; in data harvesting, &amp;ldquo; the report states.&lt;/p&gt;&lt;h3&gt;Does TikTok have connections with the Chinese government?&lt;/h3&gt;&lt;p&gt;TikTok is owned by the Chinese multinational internet company ByteDance, which is headquartered in Beijing. Founder Zhang Yiming sits at No. 28 on Bloomberg&amp;rsquo;s billionaires index.&lt;/p&gt;&lt;p&gt;Advertisement&lt;br&gt;ByteDance has denied a connection to the Chinese government in the past, and called the claim &amp;ldquo;misinformation&amp;rdquo; after various leaks suggested it censors material that does not align with Chinese foreign policy aims or mentions the country&amp;rsquo;s human rights record.&lt;/p&gt;&lt;p&gt;&amp;ldquo;They are consistent in saying their app doesn&amp;rsquo;t connect to China, isn&amp;rsquo;t accessible to Chinese authorities and wouldn&amp;rsquo;t cooperate with Chinese authorities,&amp;rdquo; Potter said.&lt;/p&gt;&lt;p&gt;But he said Internet 2.0&amp;rsquo;s research found &amp;ldquo;Chinese authorities can actually access device data&amp;rdquo;. By sending tracked bots to the app, Internet 2.0 &amp;ldquo;consistently saw &amp;hellip; data geolocating back to China&amp;rdquo;.&lt;/p&gt;&lt;p&gt;Potter has said it wasn&amp;rsquo;t clear what data was being sent, just that the app was connecting to Chinese servers.&lt;/p&gt;&lt;p&gt;This month TikTok Australia admitted its staff in China were able to access Australian data.&lt;/p&gt;&lt;p&gt;&amp;ldquo;Our security teams minimise the number of people who have access to data and limit it only to people who need that access in order to do their jobs,&amp;rdquo; Brent Thomas, the company&amp;rsquo;s Australian director of public policy, wrote in a letter. The letter was in response to questions from Senator James Paterson, the opposition&amp;rsquo;s cyber security and foreign interference spokesperson. Thomas said Australian data had never been given to the Chinese government.&lt;/p&gt;&lt;h3&gt;Are you at risk?&lt;/h3&gt;&lt;p&gt;Under China&amp;rsquo;s national security laws Chinese companies are, upon request from the government, required to share access to data they collect.&lt;/p&gt;&lt;p&gt;&amp;ldquo;You&amp;rsquo;re in a different digital ecosystem when you&amp;rsquo;re on a mainstream Chinese app,&amp;rdquo; Potter said. And &amp;ldquo;who you are&amp;rdquo; may determine the &amp;ldquo;level of risk&amp;rdquo; you are taking.&lt;/p&gt;&lt;p&gt;At an individual level, the average user might not be at immediate risk, Potter said. &amp;ldquo;But if you&amp;rsquo;re involved in something more sensitive or discussing topics that are sensitive &amp;hellip; you&amp;rsquo;ve become very interesting to them very quickly.&amp;rdquo;&lt;/p&gt;&lt;p&gt;A dissident in the Chinese diaspora community, or a critic of the Chinese government, might be &amp;ldquo;extremely concerned about their personal cyber security&amp;rdquo; on TikTok, Paterson said.&lt;/p&gt;&lt;p&gt;TikTok told a 2020 Senate committee on foreign interference on social media that any request for Australian user data would need to go through a mutual legal assistance treaty process.&lt;/p&gt;&lt;p&gt;Other governments also use their national security laws to gain access to user data from TikTok. TikTok publishes a half-yearly transparency report for data requests from governments.&lt;/p&gt;&lt;p&gt;China is not on the list of countries, but the list reveals Australian governments in the second half of 2021 made 51 requests for data related to 57 user accounts, with TikTok handing over data 41% of the time. The US made 1,306 requests for 1,003 accounts, with data handed over 86% of the time.&lt;/p&gt;&lt;h3&gt;How can I keep my data safe?&lt;/h3&gt;&lt;p&gt;TikTok is now the most downloaded mobile entertainment app in Australia, with 7.38 million users over the age of 18.&lt;/p&gt;&lt;p&gt;If you decide to keep using TikTok, Potter suggests being &amp;ldquo;specific and granular about the level of permissions shared with the app&amp;rdquo;.&lt;/p&gt;&lt;p&gt;Set permissions manually via in-app settings and in the device&amp;rsquo;s settings. Tom Kenyon, a director of Internet 2.0, also urged users to monitor those permissions regularly. &amp;ldquo;In any update, they can change access to permissions. It&amp;rsquo;s not set and forget.&amp;rdquo;&lt;/p&gt;&lt;p&gt;Potter said users should continue to &amp;ldquo;ignore requests for sharing information&amp;rdquo;. He also urged young people to avoid using TikTok for &amp;ldquo;general messaging&amp;rdquo;.&lt;/p&gt;&lt;p&gt;&amp;ldquo;If you want to share videos and look at cats, sure, go your hardest. If you&amp;rsquo;re going to have a conversation with your friends about your sexual orientation, or human rights, I&amp;rsquo;d be very wary.&amp;rdquo;&lt;/p&gt;&lt;p&gt;Kenyon said young people just starting their careers should think beyond the short term.&lt;/p&gt;&lt;p&gt;Australian artist Kira Puru&lt;br&gt;Kira Puru: the 10 funniest things I have ever seen (on the internet)&lt;br&gt;Read more&lt;br&gt;He also urged senior public servants, public officials and members of parliament to &amp;ldquo;delete TikTok and other social media&amp;rdquo;. While the data already collected will not disappear from TikTok&amp;rsquo;s database, deleting the application will stop data collection into the future. If they are wanting to continue activity across platforms, Kenyon suggested &amp;ldquo;a separate, dedicated phone&amp;rdquo;.&lt;/p&gt;&lt;h3&gt;Should TikTok be banned?&lt;/h3&gt;&lt;p&gt;Kenyon said that as it is an &amp;ldquo;avenue for data to flow to China &amp;hellip; I absolutely think [TikTok] should be banned&amp;rdquo;.&lt;/p&gt;&lt;p&gt;But Potter said he is &amp;ldquo;very rarely in favour of bans&amp;rdquo;.&lt;/p&gt;&lt;p&gt;&amp;ldquo;I am in favour of better regulation.&amp;rdquo;&lt;/p&gt;&lt;p&gt;Potter said Australia must be clear &amp;ldquo;that we expect social media companies operating in Australia to respect our norms of privacy and freedom of speech&amp;rdquo;.&lt;/p&gt;&lt;p&gt;&amp;ldquo;They need to be clear about how they operate. And if caught lying consistently, we need to have some way of holding those companies to account.&lt;/p&gt;&lt;figure class=&quot;image&quot;&gt;&lt;img src=&quot;../../../../storage/images/example-4220i.jpg&quot; alt=&quot;&quot; width=&quot;620&quot; height=&quot;411&quot;&gt;&lt;figcaption&gt;CaptionCyber security minister Clare O&amp;rsquo;Neil says she is &amp;lsquo;certainly&amp;rsquo; concerned by the data collection practices of some apps. Photograph: Darren England/AAP&lt;/figcaption&gt;&lt;/figure&gt;&lt;p&gt;The federal minister for home affairs and cyber security, Clare O&amp;rsquo;Neil, said in a statement that the Australian government &amp;ldquo;has this report and has been well aware of these issues for some years&amp;rdquo;.&lt;/p&gt;&lt;p&gt;&amp;ldquo;Australians need to be mindful &amp;hellip; that they are sharing a lot of detailed information about themselves with apps that aren&amp;rsquo;t properly protecting that information.&lt;/p&gt;&lt;p&gt;&amp;ldquo;I hope it concerns Australians because it certainly concerns me.&amp;rdquo;&lt;/p&gt;&lt;p&gt;Australian influencers have vowed to stay on the app despite concerns about Chinese data harvesting.&lt;/p&gt;&lt;p&gt;The Internet 2.0 report will be presented on Monday to a US Senate hearing on TikTok. With 142.2 million users in North America, the US is &amp;ldquo;obviously the dominant market for this app.&amp;rdquo;&lt;/p&gt;&lt;p&gt;&amp;ldquo;I would expect TikTok will come under very hard questions about how the app operates,&amp;rdquo; Potter said.&lt;/p&gt;&lt;h3&gt;What does TikTok say about the report?&lt;/h3&gt;&lt;p&gt;TikTok has rejected the Internet 2.0 report as &amp;ldquo;baseless&amp;rdquo;.&lt;/p&gt;&lt;p&gt;A TikTok spokesperson said: &amp;ldquo;The TikTok app is not unique in the amount of information it collects ... We collect information that users choose to provide to us and information that helps the app function, operate securely, and improve the user experience.&lt;/p&gt;&lt;p&gt;&amp;ldquo;The IP address is in Singapore, the network traffic does not leave the region, and it is categorically untrue to imply there is communication with China. The researcher&amp;rsquo;s conclusions reveal fundamental misunderstandings of how mobile apps work, and by their own admission, they do not have the correct testing environment to confirm their baseless claims.&amp;rdquo;&lt;/p&gt;&lt;p&gt;&lt;em&gt;With Josh Taylor&lt;/em&gt;&lt;/p&gt;&lt;p&gt;Sumber: &lt;a href=&quot;https://www.theguardian.com/technology/2022/jul/19/tiktok-has-been-accused-of-aggressive-data-harvesting-is-your-information-at-risk&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;the Guardian&lt;/a&gt;&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image33.jpg",
            "meta_description" => 'Cybersecurity experts have warned Australian TikTok users that the Chinese government could use the app to harvest personal information, from in-app messages with friends to precise device locations.',
            "meta_keyword" => 'TikTok, Social Media',
            "post_hits" => 2,
            "like" => 1,
            "created_at" => "2022-11-03 01:36:36",
            "updated_at" => "2022-11-03 01:36:36"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Social Media'),
            $this->getTagIdByLanguageCode('en', 'TikTok'),
        ]);
        $post->translations()->attach(15);

        # Post Translation Relations 16

        Translation::create([
            'id' => 16,
            'value' => json_encode([
                'en' => 34,
            ])
        ]);

        # 34

        $post = Post::create([
            "id" => 34,
            "post_title" => "The Company Behind Vespa Built A Cargo Robot That Follows You Around",
            "post_name" => "the-company-behind-vespa-built-a-cargo-robot-that-follows-you-around",
            "post_summary" => "<p>The company behind Vespa built a cargo robot that follows you around.</p>",
            "post_content" => html_entity_decode("&lt;p&gt;Ahen an unknown printer took a galley of type and their scrambled imaketype specimen book has follorrvived not only fiver centuriewhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;Travel orem Ipsum has been the industry&amp;rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a gallery Followe yof type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronics are o nic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;Mravel orem Ipsum has been the industry&amp;rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galleyof typed scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electro nic typesetting, remain ing essentially unchanged.&lt;/p&gt;&lt;p&gt;Struggling to sell one multi-million dollar home currently on the market won&amp;rsquo;t stop actress and singer Jennifer Lopez from expanding her propestate holdings an eight-plus acre estate in Bel-Air anchored by a Struggling to sell one multi-million dollar home uiurrently on the market won&amp;rsquo;t stop actress and singer Jennifer.&lt;/p&gt;&lt;h3&gt;Middle Post Heading&lt;/h3&gt;&lt;p&gt;&lt;img class=&quot;figure-img img-fluid&quot; src=&quot;http://localhost:8000/storage/images/34.jpg&quot; alt=&quot;&quot; width=&quot;640&quot; height=&quot;427&quot;&gt;&lt;/p&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you got life, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success, I can. Look at the sunset, life is amazing, life is beautiful, life is what A federal government initiated report conducted by the.&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image34.jpg",
            "meta_description" => 'The company behind Vespa built a cargo robot that follows you around',
            "meta_keyword" => 'Politics, News',
            "created_at" => "2022-11-03 04:21:18",
            "updated_at" => "2022-11-03 04:21:18"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Politics'),
            $this->getTagIdByLanguageCode('en', 'News'),
        ]);
        $post->translations()->attach(16);

        # Post Translation Relations 17

        Translation::create([
            'id' => 17,
            'value' => json_encode([
                'en' => 35,
            ])
        ]);

        # 35

        $post = Post::create([
            "id" => 35,
            "post_title" => "Are You Ready For Discover Sea Diving Position Fall Nation Area Down",
            "post_name" => "are-you-ready-for-discover-sea-diving-position-fall-nation-area-down",
            "post_content" => html_entity_decode("&lt;p&gt;Ahen an unknown printer took a galley of type and their scrambled imaketype specimen book has follorrvived not only fiver centuriewhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;Travel orem Ipsum has been the industry&amp;rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a gallery Followe yof type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronics are o nic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;Mravel orem Ipsum has been the industry&amp;rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galleyof typed scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electro nic typesetting, remain ing essentially unchanged.&lt;/p&gt;&lt;blockquote&gt;&lt;p&gt;when an unknown printer took a galley of type and scrambled it to make a type area specimen book It has survived not only five centuries.but also the leap introduce electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;Willum Skeener&lt;/p&gt;&lt;/blockquote&gt;&lt;p&gt;Struggling to sell one multi-million dollar home currently on the market won&amp;rsquo;t stop actress and singer Jennifer Lopez from expanding her propestate holdings an eight-plus acre estate in Bel-Air anchored by a Struggling to sell one multi-million dollar home uiurrently on the market won&amp;rsquo;t stop actress and singer Jennifer.&lt;/p&gt;&lt;h3&gt;Middle Post Heading&lt;/h3&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you got life, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success, I can. Look at the sunset, life is amazing, life is beautiful, life is what A federal government initiated report conducted by the.&lt;/p&gt;&lt;p&gt;Prom should never complain, complaining is a weak emoti you got life, we breathing, we blessed. Surround yourself with an gels. They never said winning.&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Pasting their cartoon to form over bags&lt;/li&gt;&lt;li&gt;Certified emergency medical technician was&lt;/li&gt;&lt;li&gt;Galaxy&amp;rsquo;s Edge the best thing about&lt;/li&gt;&lt;li&gt;Phone owner uses&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Prom should never complain, complaining is a weak emoti you got life, we breathing, we blessed. Surround yourself with an gels. They never said winning.Prom should never complain, com plaining is a weak emoti you got life, we breathing, we blessed urround yourself with angels. They never said winning.&lt;/p&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you got life, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success, I can. Look at the sunset, life is amazing, life is beautiful, life is what A federal government initiated report conducted by the.&lt;/p&gt;&lt;h3&gt;Success is how high you bounce when you hit bottom&lt;/h3&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you gotlife, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success I can. Look at the sunset.Nmply dummy text of the printing and typ esetting industry. Lorem Ipsum has been the industry&amp;rsquo;s st andard dummy text ever since the 1500s, when an unknown printer took a galley of type andse aerr crambled it to make a type specimen book.&lt;/p&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you gotlife, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success I can. Look at the sunset.Nmply dummy text of the printing and typ esetting industry. Lorem Ipsum has been the industry&amp;rsquo;s st andard dummy.&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Crisp fresh iconic elegant timeless clean perfume&lt;/li&gt;&lt;li&gt;Neck straight sharp silhouette and dart detail&lt;/li&gt;&lt;li&gt;Machine wash cold slim fit premium stretch selvedge denim comfortable low waist&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Our should never complain, complaining is a weak emotion, you gotlife, we breathing, we blessed. Surround yourself with angels. They never said winning was easy. Some people can&amp;rsquo;t handle success I can. Look at the sunset.Nmply dummy text of the printing and typ esetting industry. Lorem Ipsum has been the industry&amp;rsquo;s st andard dummy.&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image35.jpg",
            "meta_description" => 'Ahen an unknown printer took a galley of type and their scrambled imaketype specimen book has follorrvived not only fiver centuriewhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essentially unchanged.',
            "meta_keyword" => 'Lifestyle, Adventure',
            "created_at" => "2022-11-03 04:34:02",
            "updated_at" => "2022-11-03 04:34:02"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getCategoryIdByLanguageCode('en', 'Adventure'),
            $this->getTagIdByLanguageCode('en', 'Adventure'),
            $this->getTagIdByLanguageCode('en', 'Beach'),
        ]);
        $post->translations()->attach(17);

        # Post Translation Relations 18

        Translation::create([
            'id' => 18,
            'value' => json_encode([
                'en' => 36,
            ])
        ]);

        # 36

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 36,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" => PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image36.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:39:01",
            "updated_at" => "2022-11-03 04:39:01"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Adventure'),
            $this->getTagIdByLanguageCode('en', 'Beach'),
        ]);
        $post->translations()->attach(18);

        # Post Translation Relations 19

        Translation::create([
            'id' => 19,
            'value' => json_encode([
                'en' => 37,
            ])
        ]);

        # 37

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 37,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image37.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:41:49",
            "updated_at" => "2022-11-03 04:41:49"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Adventure'),
            $this->getTagIdByLanguageCode('en', 'Beach'),
        ]);
        $post->translations()->attach(19);

        # Post Translation Relations 20

        Translation::create([
            'id' => 20,
            'value' => json_encode([
                'en' => 38,
            ])
        ]);

        # 38

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 38,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image38.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:48:13",
            "updated_at" => "2022-11-03 04:48:13"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
        ]);
        $post->translations()->attach(20);

        # Post Translation Relations 21

        Translation::create([
            'id' => 21,
            'value' => json_encode([
                'en' => 39,
            ])
        ]);

        # 39

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 39,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image39.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:51:19",
            "updated_at" => "2022-11-03 04:51:19"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(21);

        # Post Translation Relations 22

        Translation::create([
            'id' => 22,
            'value' => json_encode([
                'en' => 40,
            ])
        ]);

        # 40

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 40,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image40.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:54:06",
            "updated_at" => "2022-11-03 04:54:06"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(22);

        # Post Translation Relations 22

        Translation::create([
            'id' => 23,
            'value' => json_encode([
                'en' => 41,
            ])
        ]);

        # 41

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 41,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image41.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:56:54",
            "updated_at" => "2022-11-03 04:56:54"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(23);

        # Post Translation Relations 24

        Translation::create([
            'id' => 24,
            'value' => json_encode([
                'en' => 42,
            ])
        ]);

        # 42

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 42,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image42.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 04:59:02",
            "updated_at" => "2022-11-03 04:59:02"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(24);

        # Post Translation Relations 25

        Translation::create([
            'id' => 25,
            'value' => json_encode([
                'en' => 43,
            ])
        ]);

        # 43

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 43,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image43.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 05:03:36",
            "updated_at" => "2022-11-03 05:03:36"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Adventure'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Wildlife'),
        ]);
        $post->translations()->attach(25);

        # Post Translation Relations 26

        Translation::create([
            'id' => 26,
            'value' => json_encode([
                'en' => 44,
            ])
        ]);

        # 44

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 44,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image44.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 05:18:36",
            "updated_at" => "2022-11-03 05:18:36"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Sport'),
            $this->getTagIdByLanguageCode('en', 'Athlete'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(26);

        # Post Translation Relations 27

        Translation::create([
            'id' => 27,
            'value' => json_encode([
                'en' => 45,
            ])
        ]);

        # 45

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 45,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image45.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 05:21:46",
            "updated_at" => "2022-11-03 05:21:46"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'News'),
            $this->getTagIdByLanguageCode('en', 'Wildlife'),
            $this->getTagIdByLanguageCode('en', 'Lifestyle'),
        ]);
        $post->translations()->attach(27);

        # Post Translation Relations 28

        Translation::create([
            'id' => 28,
            'value' => json_encode([
                'en' => 46,
            ])
        ]);

        # 46

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 46,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image46.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:12:45",
            "updated_at" => "2022-11-03 08:12:45"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology'),
            $this->getTagIdByLanguageCode('en', 'Google'),
            $this->getTagIdByLanguageCode('en', 'Oculus'),
        ]);
        $post->translations()->attach(28);

        # Post Translation Relations 29

        Translation::create([
            'id' => 29,
            'value' => json_encode([
                'en' => 47,
            ])
        ]);

        # 47

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 47,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image47.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:15:48",
            "updated_at" => "2022-11-03 08:15:48"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Furniture'),
            $this->getTagIdByLanguageCode('en', 'Decoration'),
        ]);
        $post->translations()->attach(29);

        # Post Translation Relations 30

        Translation::create([
            'id' => 30,
            'value' => json_encode([
                'en' => 48,
            ])
        ]);

        # 48

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 48,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image48.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:20:01",
            "updated_at" => "2022-11-03 08:20:01"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Bitcoin'),
            $this->getTagIdByLanguageCode('en', 'Crypto'),
            $this->getTagIdByLanguageCode('en', 'Dollar'),
        ]);
        $post->translations()->attach(30);

        # Post Translation Relations 31

        Translation::create([
            'id' => 31,
            'value' => json_encode([
                'en' => 49,
            ])
        ]);

        # 49

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 49,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image49.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:21:54",
            "updated_at" => "2022-11-03 08:21:54"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Bitcoin'),
            $this->getTagIdByLanguageCode('en', 'Crypto'),
            $this->getTagIdByLanguageCode('en', 'Dollar'),
        ]);
        $post->translations()->attach(31);

        # Post Translation Relations 32

        Translation::create([
            'id' => 32,
            'value' => json_encode([
                'en' => 50,
            ])
        ]);

        # 50

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 50,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image50.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:21:54",
            "updated_at" => "2022-11-03 08:21:54"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Bitcoin'),
            $this->getTagIdByLanguageCode('en', 'Crypto'),
            $this->getTagIdByLanguageCode('en', 'Dollar'),
        ]);
        $post->translations()->attach(32);

        # Post Translation Relations 33

        Translation::create([
            'id' => 33,
            'value' => json_encode([
                'en' => 51,
            ])
        ]);

        # 51

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 51,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image51.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-03 08:24:37",
            "updated_at" => "2022-11-03 08:24:37"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Business'),
            $this->getTagIdByLanguageCode('en', 'Economic'),
            $this->getTagIdByLanguageCode('en', 'Politics'),
            $this->getTagIdByLanguageCode('en', 'Dollar'),
        ]);
        $post->translations()->attach(33);

        # Post Translation Relations 34

        Translation::create([
            'id' => 34,
            'value' => json_encode([
                'en' => 52,
            ])
        ]);

        # 52

        $post = Post::create([
            "id" => 52,
            "post_title" => "How To Burn Calories With Pleasant Activities",
            "post_name" => "how-to-burn-calories-with-pleasant-activities",
            "post_summary" => "<p>How to Burn Calories with Pleasant Activities<br></p>",
            "post_content" => html_entity_decode("&lt;p&gt;This oven-baked method will ensure your pork has a delicious crust and a perfectly cooked interior. Just follow these simple rules and prepare yourself to reconsider everything you know about this weeknight-friendly cut.&lt;/p&gt;&lt;p&gt;Pair this delicious dish with a risotto and a nice bottle of wine. This Italian favorite is easy to make and sure to impress your guests.&lt;/p&gt;&lt;h3&gt;Ingredients&lt;/h3&gt;&lt;ul&gt;&lt;li&gt;2 cups half and half&lt;/li&gt;&lt;li&gt;1/4 cup limoncello&lt;/li&gt;&lt;li&gt;3 Tbsp granulated sugar&lt;/li&gt;&lt;li&gt;1/4 tsp vanilla extract&lt;/li&gt;&lt;li&gt;1/2 tsp finely grated lemon zest&lt;/li&gt;&lt;li&gt;1/8 tsp kosher salt&lt;/li&gt;&lt;li&gt;3 large eggs&lt;/li&gt;&lt;li&gt;Unsalted butter, for buttering the casserole dish&lt;/li&gt;&lt;li&gt;5 cups challah (about 8 oz)&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;&lt;p&gt;It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image52.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-04 03:59:03",
            "updated_at" => "2022-11-04 03:59:03"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Lifestyle'),
            $this->getTagIdByLanguageCode('en', 'Health'),
            $this->getTagIdByLanguageCode('en', 'Recipes'),
            $this->getTagIdByLanguageCode('en', 'Food'),
        ]);
        $post->translations()->attach(34);

        # Post Translation Relations 35

        Translation::create([
            'id' => 35,
            'value' => json_encode([
                'en' => 53,
            ])
        ]);

        # 53

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 53,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image53.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-04 03:59:03",
            "updated_at" => "2022-11-04 03:59:03"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Medical'),
            $this->getTagIdByLanguageCode('en', 'Clinic'),
            $this->getTagIdByLanguageCode('en', 'Health'),
            $this->getTagIdByLanguageCode('en', 'Doctor'),
            $this->getTagIdByLanguageCode('en', 'Dentist'),
        ]);
        $post->translations()->attach(35);

        # Post Translation Relations 36

        Translation::create([
            'id' => 36,
            'value' => json_encode([
                'en' => 54,
            ])
        ]);

        # 54

        $faker = Faker::create();

        $title = $faker->sentence;
        $slug = Str::slug($title, '-');

        $post = Post::create([
            "id" => 54,
            "post_title" => $title,
            "post_name" => $slug,
            "post_summary" => '<p>'.$faker->paragraph.'</p>',
            "post_content" =>PostHelper::createParagraph(5),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "post",
            "post_image" => "image54.jpg",
            "meta_description" => $faker->sentence,
            "meta_keyword" => PostHelper::createKeyword(3),
            "created_at" => "2022-11-04 10:59:51",
            "updated_at" => "2022-11-04 10:59:51"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Medical'),
            $this->getTagIdByLanguageCode('en', 'Clinic'),
            $this->getTagIdByLanguageCode('en', 'Health'),
            $this->getTagIdByLanguageCode('en', 'Doctor'),
        ]);
        $post->translations()->attach(36);

        # Post Translation Relations 37

        Translation::create([
            'id' => 37,
            'value' => json_encode([
                'en' => 55
            ])
        ]);

        # 55

        $post = Post::create([
            "id" => 55,
            "post_title" => "Artificial Intelligence Crash Course 2023: A Comprehensive Guide To Ai",
            "post_name" => "artificial-intelligence-crash-course-2023-a-comprehensive-guide-to-ai",
            "post_content" => "<p>Artificial Intelligence, or AI, is a rapidly growing field that is changing the way we live and work. From self-driving cars to intelligent virtual assistants, AI is transforming industries across the board. If you\'re looking to learn about AI, you\'re in the right place. In this comprehensive video course, we\'ll cover all the key topics in AI, including machine learning, neural networks, natural language processing, and more.</p>\r\n<p>First, let\'s start with the basics. What is AI? Simply put, AI refers to the ability of machines to perform tasks that typically require human intelligence, such as recognizing speech, making decisions, and solving problems. There are a number of different techniques used in AI, including machine learning, neural networks, and natural language processing.</p>\r\n<p>Machine learning is a subset of AI that involves training machines to learn from data. Essentially, a machine is given a large set of data and uses that data to identify patterns and make predictions. For example, a machine learning algorithm might be trained on a dataset of customer purchase histories to identify which products are most likely to be purchased together.</p>\r\n<p>Neural networks are another important technique in AI. Neural networks are modeled after the structure of the human brain and are designed to learn from data. They are particularly useful for tasks such as image recognition and natural language processing. Essentially, a neural network consists of a large number of interconnected nodes, or \"neurons,\" that work together to analyze data and make predictions.</p>\r\n<p>Natural language processing, or NLP, is another important area of AI. NLP refers to the ability of machines to understand and process human language. This includes tasks such as speech recognition, sentiment analysis, and language translation. NLP is particularly important for applications such as virtual assistants and chatbots, which rely on natural language input from users.</p>\r\n<p>Of course, these are just a few of the many techniques and applications of AI. In this video course, we\'ll dive deeper into each of these areas and explore how they are being used in real-world applications.</p>\r\n<p>One of the most exciting aspects of AI is its potential to transform industries across the board. For example, in healthcare, AI is being used to analyze medical images and diagnose diseases. In finance, AI is being used to detect fraud and predict market trends. And in manufacturing, AI is being used to optimize supply chains and improve quality control.</p>\r\n<p>But with great power comes great responsibility. As AI continues to advance, there are also concerns about its potential impact on society. For example, there are concerns about job displacement as AI takes over tasks that were previously performed by humans. There are also concerns about bias in AI systems, which can perpetuate existing social inequalities.</p>\r\n<p>In this video course, we\'ll explore both the potential and the challenges of AI. We\'ll look at how AI is being used to solve some of the world\'s most pressing problems, and we\'ll also examine the ethical implications of AI and how we can ensure that it is developed and used in a responsible way.</p>\r\n<p>Whether you\'re a complete beginner or an experienced practitioner, this video course is the perfect way to learn about AI. With engaging visuals, easy-to-understand explanations, and practical examples, you\'ll gain a deep understanding of the key concepts and applications of AI. So what are you waiting for? Sign up today and join the AI revolution!</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "video_url",
            "post_image" => "image55.jpg",
            "post_source" => "https://www.youtube.com/watch?v=xabR5c0LsYQ",
            "created_at" => "2023-06-03 09:55:02",
            "updated_at" => "2023-06-03 09:55:02"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology')
        ]);
        $post->translations()->attach(37);

        # Post Translation Relations 38

        Translation::create([
            'id' => 38,
            'value' => json_encode([
                'en' => 56
            ])
        ]);

         # 56

        $post = Post::create([
            "id" => 56,
            "post_title" => "Top 10 Amazing Future Technologies That Will Change Our World",
            "post_name" => "top-10-amazing-future-technologies-that-will-change-our-world",
            "post_content" => "<p>In this video, we're going to take a look at 10 amazing future technologies that will change our world. From Sand batteries to AI image-generation, these technologies are poised to have a big impact on the way we live our lives.</p><p>So check out this video and learn about some of the most exciting technologies that will change our world in the future! From self-driving cars to implantable medical devices, these technologies are poised to have a big impact on the way we live our lives!</p><p>The future is here and it's amazing. In this video, I'm going to show you the top 10 technologies that will change our world in the next 5 years. You will be so amazed by how much we have advanced over the past few years, you'll wonder why we don't live in a sci-fi movie! So sit back, relax and enjoy.</p><p>From VR to AI, from Drones to Self-driving cars, this video will make you dream about the future. Discover the top 10 technologies that will change our world and will give you a glimpse of what our kids can expect.</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "video_url",
            "post_image" => "image56.jpg",
            "post_source" => "https://www.youtube.com/watch?v=-1ZFq5HUfzM",
            "created_at" => "2023-06-03 16:56:45",
            "updated_at" => "2023-06-03 16:56:45"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology')
        ]);
        $post->translations()->attach(38);

        # Post Translation Relations 39

        Translation::create([
            'id' => 39,
            'value' => json_encode([
                'en' => 57
            ])
        ]);

        # 57

        $post = Post::create([
            "id" => 57,
            "post_title" => "Top 7 Technology Trends In 2023",
            "post_name" => "top-7-technology-trends-in-2023",
            "post_content" => "<p>In this video TOP 7 Technology Trends in 2023. What kind of future technology should we expect? Let's talk about latest technology in 2023</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "video_url",
            "post_image" => "image57.jpg",
            "post_source" => "https://www.youtube.com/watch?v=ZSiXZxVpVhs",
            "created_at" => "2023-06-03 16:58:20",
            "updated_at" => "2023-06-03 16:58:20"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology')
        ]);
        $post->translations()->attach(39);

        # Post Translation Relations 40

        Translation::create([
            'id' => 40,
            'value' => json_encode([
                'en' => 58
            ])
        ]);

        # 58

        $post = Post::create([
            "id" => 58,
            "post_title" => "What Is 5G And How Does It Work? Ksat Explains",
            "post_name" => "what-is-5g-and-how-does-it-work-ksat-explains",
            "post_content" => "<p>In this KSAT Explains, we breakdown what 5G means, what regulations are in place for the devices to be installed and what doctors are saying about the potential health risks associated with the technology.</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "video_url",
            "post_image" => "image58.jpg",
            "post_source" => "https://www.youtube.com/watch?v=AMqkz79KrnM",
            "created_at" => "2023-06-03 16:59:17",
            "updated_at" => "2023-06-03 16:59:17"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Technology')
        ]);
        $post->translations()->attach(40);

        # Post Translation Relations 41

        Translation::create([
            'id' => 41,
            'value' => json_encode([
                'en' => 59
            ])
        ]);

        # 59

        $post = Post::create([
            "id" => 59,
            "post_title" => "Mindfulness: Meditation 1 - Mindfulness Of Body And Breath",
            "post_name" => "mindfulness-meditation-1-mindfulness-of-body-and-breath",
            "post_content" => "<p>A download of guided meditations aimed to complement the learnings found in Prof Mark William's and Dr Danny Penman's guide to freeing yourself from the stresses of everyday life. Containing all the meditations that are mentioned in the book this is an invaluable resource to cement their teachings on how to find Mindfulness, and how to keep it.</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "audio_embed",
            "post_source" => html_entity_decode("&lt;iframe width=&quot;100%&quot; height=&quot;300&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot; allow=&quot;autoplay&quot; src=&quot;https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/709659910&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true&amp;visual=true&quot;&gt;&lt;/iframe&gt;&lt;div style=&quot;font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;&quot;&gt;&lt;a href=&quot;https://soundcloud.com/hachetteaudiouk&quot; title=&quot;Hachette Audio UK&quot; target=&quot;_blank&quot; style=&quot;color: #cccccc; text-decoration: none;&quot;&gt;Hachette Audio UK&lt;/a&gt; &#xb7; &lt;a href=&quot;https://soundcloud.com/hachetteaudiouk/meditation-1-mindfulness-of-body-and-breath&quot; title=&quot;Mindfulness: Meditation 1 - Mindfulness Of Body And Breath&quot; target=&quot;_blank&quot; style=&quot;color: #cccccc; text-decoration: none;&quot;&gt;Mindfulness: Meditation 1 - Mindfulness Of Body And Breath&lt;/a&gt;&lt;/div&gt;"),
            "created_at" => "2023-06-04 11:36:43",
            "updated_at" => "2023-06-04 11:36:43"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Health')
        ]);
        $post->translations()->attach(41);

        # Post Translation Relations 42

        Translation::create([
            'id' => 42,
            'value' => json_encode([
                'en' => 60
            ])
        ]);

        # 60

        $post = Post::create([
            "id" => 60,
            "post_title" => "Soundhelix Song 1 Mp3",
            "post_name" => "soundhelix-song-1-mp3",
            "post_content" => "<p>A download of guided meditations aimed to complement the learnings found in Prof Mark William's and Dr Danny Penman's guide to freeing yourself from the stresses of everyday life. Containing all the meditations that are mentioned in the book this is an invaluable resource to cement their teachings on how to find Mindfulness, and how to keep it.</p>",
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "audio_file",
            "post_image" => 'image60.jpg',
            "post_source" => 'SoundHelix.mp3',
            "created_at" => "2023-06-04 11:41:08",
            "updated_at" => "2023-06-04 11:41:08"
        ]);
        $post->terms()->sync([
            $this->getCategoryIdByLanguageCode('en', 'Science')
        ]);
        $post->translations()->attach(42);

      
        # Page Translation Relations 43

        Translation::create([
            'id' => 43,
            'value' => json_encode([
                'en' => 61,
                'id' => 62,
                'ar' => 63,
            ])
        ]);

        # 61

        Post::create([
            "id" => 61,
            "post_title" => "About",
            "post_name" => "about",
            "post_content" => html_entity_decode("&lt;p style=&quot;text-align: left;&quot;&gt;&lt;strong&gt;dhakawatch &amp;ndash; Laravel News &amp;amp; Blog CMS Script&lt;/strong&gt; is a complete solution for any kind of News, Magazine and Blog Portal. This cms Includes almost everything you need. This CMS (Content Mangement System) Administrator System or Backend you can use this Laravel 9 framework integration with the AdminLTE template.&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;dhakawatch is fully responsive for any device with four attractive templates. Laravel 9 PHP Framework is used to develop this system so dhakawatch theme is ready to use, If you&amp;rsquo;re a developer, you can also easy to modify theme. and front-end build websites based on Bootstrap.&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;div class=&quot;ratio ratio-16x9&quot;&gt;&lt;iframe class=&quot;responsive-iframe&quot; title=&quot;YouTube video player&quot; src=&quot;https://www.youtube.com/embed/mRlP799y8B8&quot; frameborder=&quot;0&quot; allowfullscreen=&quot;allowfullscreen&quot;&gt;&lt;/iframe&gt;&lt;/div&gt;"),
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "page",
        ])->translations()->attach(43);

        # 62

        Post::create([
            "id" => 62,
            "post_title" => "Tentang",
            "post_name" => "tentang",
            "post_content" => html_entity_decode("&lt;p style=&quot;text-align: left;&quot;&gt;&lt;strong&gt;dhakawatch &amp;ndash; Laravel News &amp;amp; Blog CMS Script &lt;/strong&gt;adalah solusi lengkap untuk semua jenis Portal Berita, Majalah, dan Blog. Cms ini Mencakup hampir semua yang Anda butuhkan. CMS (Content Mangement System) Administrator System atau Backend ini bisa anda gunakan integrasi framework Laravel 9 ini dengan template AdminLTE.&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;dhakawatch sepenuhnya responsif untuk perangkat apa pun dengan empat templat menarik. Laravel 9 PHP Framework digunakan untuk mengembangkan sistem ini sehingga tema dhakawatch siap digunakan, Jika Anda seorang pengembang, Anda juga dapat memodifikasi tema dengan mudah. dan membangun situs web front-end berdasarkan Bootstrap.&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;div class=&quot;ratio ratio-16x9&quot;&gt;&lt;iframe class=&quot;responsive-iframe&quot; title=&quot;YouTube video player&quot; src=&quot;https://www.youtube.com/embed/mRlP799y8B8&quot; frameborder=&quot;0&quot; allowfullscreen=&quot;allowfullscreen&quot;&gt;&lt;/iframe&gt;&lt;/div&gt;"),
            "post_author" => 2,
            "post_language" => 2,
            "post_type" => "page",
        ])->translations()->attach(43);

        # 63

        Post::create([
            "id" => 63,
            "post_title" => "حول",
            "post_name" => "hol",
            "post_content" => html_entity_decode("&lt;p&gt;&lt;strong&gt;dhakawatch - Laravel News &amp;amp; Blog CMS Script&lt;/strong&gt; &#x647;&#x648; &#x62d;&#x644; &#x643;&#x627;&#x645;&#x644; &#x644;&#x623;&#x64a; &#x646;&#x648;&#x639; &#x645;&#x646; &#x628;&#x648;&#x627;&#x628;&#x629; &#x627;&#x644;&#x623;&#x62e;&#x628;&#x627;&#x631; &#x648;&#x627;&#x644;&#x645;&#x62c;&#x644;&#x627;&#x62a; &#x648;&#x627;&#x644;&#x645;&#x62f;&#x648;&#x646;&#x627;&#x62a;. &#x64a;&#x634;&#x645;&#x644; &#x647;&#x630;&#x627; &#x633;&#x645; &#x643;&#x644; &#x645;&#x627; &#x62a;&#x62d;&#x62a;&#x627;&#x62c;&#x647; &#x62a;&#x642;&#x631;&#x64a;&#x628;&#x64b;&#x627;. &#x64a;&#x645;&#x643;&#x646;&#x643; &#x627;&#x633;&#x62a;&#x62e;&#x62f;&#x627;&#x645; &#x646;&#x638;&#x627;&#x645; &#x625;&#x62f;&#x627;&#x631;&#x629; CMS (&#x646;&#x638;&#x627;&#x645; &#x625;&#x62f;&#x627;&#x631;&#x629; &#x627;&#x644;&#x645;&#x62d;&#x62a;&#x648;&#x649;) &#x623;&#x648; &#x627;&#x644;&#x648;&#x627;&#x62c;&#x647;&#x629; &#x627;&#x644;&#x62e;&#x644;&#x641;&#x64a;&#x629; &#x644;&#x62a;&#x643;&#x627;&#x645;&#x644; &#x625;&#x637;&#x627;&#x631; &#x639;&#x645;&#x644; Laravel 9 &#x645;&#x639; &#x642;&#x627;&#x644;&#x628; AdminLTE.&lt;/p&gt;&lt;p&gt;dhakawatch &#x645;&#x633;&#x62a;&#x62c;&#x64a;&#x628; &#x62a;&#x645;&#x627;&#x645;&#x64b;&#x627; &#x644;&#x623;&#x64a; &#x62c;&#x647;&#x627;&#x632; &#x628;&#x623;&#x631;&#x628;&#x639;&#x629; &#x642;&#x648;&#x627;&#x644;&#x628; &#x62c;&#x630;&#x627;&#x628;&#x629;. &#x64a;&#x62a;&#x645; &#x627;&#x633;&#x62a;&#x62e;&#x62f;&#x627;&#x645; Laravel 9 PHP Framework &#x644;&#x62a;&#x637;&#x648;&#x64a;&#x631; &#x647;&#x630;&#x627; &#x627;&#x644;&#x646;&#x638;&#x627;&#x645; &#x628;&#x62d;&#x64a;&#x62b; &#x62a;&#x643;&#x648;&#x646; &#x633;&#x645;&#x629; dhakawatch &#x62c;&#x627;&#x647;&#x632;&#x629; &#x644;&#x644;&#x627;&#x633;&#x62a;&#x62e;&#x62f;&#x627;&#x645; &#x60c; &#x625;&#x630;&#x627; &#x643;&#x646;&#x62a; &#x645;&#x637;&#x648;&#x631;&#x64b;&#x627; &#x60c; &#x641;&#x64a;&#x645;&#x643;&#x646;&#x643; &#x623;&#x64a;&#x636;&#x64b;&#x627; &#x62a;&#x639;&#x62f;&#x64a;&#x644; &#x627;&#x644;&#x633;&#x645;&#x629; &#x628;&#x633;&#x647;&#x648;&#x644;&#x629;. &#x648;&#x625;&#x646;&#x634;&#x627;&#x621; &#x645;&#x648;&#x627;&#x642;&#x639; &#x648;&#x64a;&#x628; &#x644;&#x644;&#x648;&#x627;&#x62c;&#x647;&#x629; &#x627;&#x644;&#x623;&#x645;&#x627;&#x645;&#x64a;&#x629; &#x627;&#x633;&#x62a;&#x646;&#x627;&#x62f;&#x64b;&#x627; &#x625;&#x644;&#x649; Bootstrap.&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;div class=&quot;ratio ratio-16x9&quot;&gt;&lt;iframe class=&quot;responsive-iframe&quot; title=&quot;YouTube video player&quot; src=&quot;https://www.youtube.com/embed/mRlP799y8B8&quot; frameborder=&quot;0&quot; allowfullscreen=&quot;allowfullscreen&quot;&gt;&lt;/iframe&gt;&lt;/div&gt;"),
            "post_author" => 3,
            "post_language" => 3,
            "post_type" => "page",
        ])->translations()->sync(43);

        # PAGE TERM & CONDITIONS
        # Page Translation Relations 38

        Translation::create([
            'id' => 44,
            'value' => json_encode([
                'en' => 64,
            ])
        ]);

        # 64

        Post::create([
            "id" => 64,
            "post_title" => "Terms & Conditions",
            "post_name" => "terms-conditions",
            "post_content" => html_entity_decode("&lt;p&gt;&amp;lt;h3&amp;gt;Terms and Conditions&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;Last updated: July 18, 2021&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Please read these terms and conditions carefully before using Our Service.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Interpretation and Definitions&amp;lt;/h3&amp;gt;&amp;lt;h4&amp;gt;Interpretation&amp;lt;/h4&amp;gt;&amp;lt;p&amp;gt;The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Definitions&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;For the purposes of these Terms and Conditions:&amp;lt;/p&amp;gt;&amp;lt;ul&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Affiliate&amp;lt;/strong&amp;gt; means an entity that controls, is controlled by or is under common control with a party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Country&amp;lt;/strong&amp;gt; refers to:&amp;nbsp; Indonesia&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Company&amp;lt;/strong&amp;gt; (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Retenvi, Jalan Alimudin Umar.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Device&amp;lt;/strong&amp;gt; means any device that can access the Service such as a computer, a cellphone or a digital tablet.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Service&amp;lt;/strong&amp;gt; refers to the Website.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Terms and Conditions&amp;lt;/strong&amp;gt; (also referred as &quot;Terms&quot;) mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service. This Terms and Conditions agreement has been created with the help of the &amp;lt;a href=&quot;https://www.termsfeed.com/terms-conditions-generator/&quot; target=&quot;_blank&quot;&amp;gt;Terms and Conditions Generator&amp;lt;/a&amp;gt;.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Third-party Social Media Service&amp;lt;/strong&amp;gt; means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;Website&amp;lt;/strong&amp;gt; refers to Retenvi, accessible from &amp;lt;a href=&quot;https://retenvi.com&quot; rel=&quot;external nofollow noopener&quot; target=&quot;_blank&quot;&amp;gt;https://retenvi.com&amp;lt;/a&amp;gt;&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;You&amp;lt;/strong&amp;gt; means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.&amp;lt;/p&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;h3&amp;gt;Acknowledgment&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Links to Other Websites&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;Our Service may contain links to third-party web sites or services that are not owned or controlled by the Company.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services that You visit.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Termination&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Upon termination, Your right to use the Service will cease immediately.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Limitation of Liability&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven&apos;t purchased anything through the Service.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party&apos;s liability will be limited to the greatest extent permitted by law.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Without limiting the foregoing, neither the Company nor any of the company&apos;s provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Governing Law&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Disputes Resolution&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;For European Union (EU) Users&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which you are resident in.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;United States Legal Compliance&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a &quot;terrorist supporting&quot; country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Severability and Waiver&amp;lt;/h3&amp;gt;&amp;lt;h4&amp;gt;Severability&amp;lt;/h4&amp;gt;&amp;lt;p&amp;gt;If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Waiver&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Terms shall not effect a party&apos;s ability to exercise such right or require such performance at any time thereafter nor shall be the waiver of a breach constitute a waiver of any subsequent breach.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Translation Interpretation&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;These Terms and Conditions may have been translated if We have made them available to You on our Service.You agree that the original English text shall prevail in the case of a dispute.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Changes to These Terms and Conditions&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days&apos; notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.&amp;lt;/p&amp;gt;&amp;lt;h3&amp;gt;Contact Us&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;If you have any questions about these Terms and Conditions, You can contact us:&amp;lt;/p&amp;gt;&amp;lt;ul&amp;gt;&amp;lt;li&amp;gt;By email: cs@retenvi.com&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&lt;br&gt;&lt;/p&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "page",
        ])->translations()->attach(44);

        # PAGE PRIVACY POLICY
        # Page Translation Relations 39

        Translation::create([
            'id' => 45,
            'value' => json_encode([
                'en' => 65,
            ])
        ]);

        # 65

        Post::create([
            "id" => 65,
            "post_title" => "Privacy Policy",
            "post_name" => "privacy-policy",
            "post_content" => html_entity_decode("&lt;h1&gt;Privacy Policy&lt;/h1&gt;&lt;p&gt;Last updated: July 23, 2022&lt;/p&gt;&lt;p&gt;This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.&lt;/p&gt;&lt;p&gt;We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy. This Privacy Policy has been created with the help of the &lt;a href=&quot;https://www.termsfeed.com/privacy-policy-generator/&quot; target=&quot;_blank&quot;&gt;TermsFeed Privacy Policy Generator&lt;/a&gt;.&lt;/p&gt;&lt;h1&gt;Interpretation and Definitions&lt;/h1&gt;&lt;h2&gt;Interpretation&lt;/h2&gt;&lt;p&gt;The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.&lt;/p&gt;&lt;h2&gt;Definitions&lt;/h2&gt;&lt;p&gt;For the purposes of this Privacy Policy:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Account&lt;/strong&gt; means a unique account created for You to access our Service or parts of our Service.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Company&lt;/strong&gt; (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Retenvi.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Cookies&lt;/strong&gt; are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Country&lt;/strong&gt; refers to:  Indonesia&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Device&lt;/strong&gt; means any device that can access the Service such as a computer, a cellphone or a digital tablet.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Personal Data&lt;/strong&gt; is any information that relates to an identified or identifiable individual.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Service&lt;/strong&gt; refers to the Website.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Service Provider&lt;/strong&gt; means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Usage Data&lt;/strong&gt; refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Website&lt;/strong&gt; refers to Retenvi, accessible from &lt;a href=&quot;https://retenvi.com&quot; rel=&quot;external nofollow noopener&quot; target=&quot;_blank&quot;&gt;https://retenvi.com&lt;/a&gt;&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;You&lt;/strong&gt; means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h1&gt;Collecting and Using Your Personal Data&lt;/h1&gt;&lt;h2&gt;Types of Data Collected&lt;/h2&gt;&lt;h3&gt;Personal Data&lt;/h3&gt;&lt;p&gt;While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;p&gt;Email address&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;Usage Data&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h3&gt;Usage Data&lt;/h3&gt;&lt;p&gt;Usage Data is collected automatically when using the Service.&lt;/p&gt;&lt;p&gt;Usage Data may include information such as Your Device&apos;s Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.&lt;/p&gt;&lt;p&gt;When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.&lt;/p&gt;&lt;p&gt;We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.&lt;/p&gt;&lt;h3&gt;Tracking Technologies and Cookies&lt;/h3&gt;&lt;p&gt;We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service. The technologies We use may include:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Cookies or Browser Cookies.&lt;/strong&gt; A cookie is a small file placed on Your Device. You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service. Unless you have adjusted Your browser setting so that it will refuse Cookies, our Service may use Cookies.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Flash Cookies.&lt;/strong&gt; Certain features of our Service may use local stored objects (or Flash Cookies) to collect and store information about Your preferences or Your activity on our Service. Flash Cookies are not managed by the same browser settings as those used for Browser Cookies. For more information on how You can delete Flash Cookies, please read &quot;Where can I change the settings for disabling, or deleting local shared objects?&quot; available at &lt;a href=&quot;https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_&quot; rel=&quot;external nofollow noopener&quot; target=&quot;_blank&quot;&gt;https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_&lt;/a&gt;&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Web Beacons.&lt;/strong&gt; Certain sections of our Service and our emails may contain small electronic files known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that permit the Company, for example, to count users who have visited those pages or opened an email and for other related website statistics (for example, recording the popularity of a certain section and verifying system and server integrity).&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Cookies can be &quot;Persistent&quot; or &quot;Session&quot; Cookies. Persistent Cookies remain on Your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close Your web browser. You can learn more about cookies on &lt;a href=&quot;https://www.termsfeed.com/blog/cookies/#What_Are_Cookies&quot; target=&quot;_blank&quot;&gt;TermsFeed website&lt;/a&gt; article.&lt;/p&gt;&lt;p&gt;We use both Session and Persistent Cookies for the purposes set out below:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Necessary / Essential Cookies&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Type: Session Cookies&lt;/p&gt;&lt;p&gt;Administered by: Us&lt;/p&gt;&lt;p&gt;Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Cookies Policy / Notice Acceptance Cookies&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Type: Persistent Cookies&lt;/p&gt;&lt;p&gt;Administered by: Us&lt;/p&gt;&lt;p&gt;Purpose: These Cookies identify if users have accepted the use of cookies on the Website.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Functionality Cookies&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Type: Persistent Cookies&lt;/p&gt;&lt;p&gt;Administered by: Us&lt;/p&gt;&lt;p&gt;Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;For more information about the cookies we use and your choices regarding cookies, please visit our Cookies Policy or the Cookies section of our Privacy Policy.&lt;/p&gt;&lt;h2&gt;Use of Your Personal Data&lt;/h2&gt;&lt;p&gt;The Company may use Personal Data for the following purposes:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;To provide and maintain our Service&lt;/strong&gt;, including to monitor the usage of our Service.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;To manage Your Account:&lt;/strong&gt; to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;For the performance of a contract:&lt;/strong&gt; the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;To contact You:&lt;/strong&gt; To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application&apos;s push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;To provide You&lt;/strong&gt; with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;To manage Your requests:&lt;/strong&gt; To attend and manage Your requests to Us.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;For business transfers:&lt;/strong&gt; We may use Your information to evaluate or conduct a merger, divestiture, restructuring, reorganization, dissolution, or other sale or transfer of some or all of Our assets, whether as a going concern or as part of bankruptcy, liquidation, or similar proceeding, in which Personal Data held by Us about our Service users is among the assets transferred.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;For other purposes&lt;/strong&gt;: We may use Your information for other purposes, such as data analysis, identifying usage trends, determining the effectiveness of our promotional campaigns and to evaluate and improve our Service, products, services, marketing and your experience.&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;We may share Your personal information in the following situations:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;With Service Providers:&lt;/strong&gt; We may share Your personal information with Service Providers to monitor and analyze the use of our Service,  to contact You.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;For business transfers:&lt;/strong&gt; We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of Our business to another company.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;With Affiliates:&lt;/strong&gt; We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners or other companies that We control or that are under common control with Us.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;With business partners:&lt;/strong&gt; We may share Your information with Our business partners to offer You certain products, services or promotions.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;With other users:&lt;/strong&gt; when You share personal information or otherwise interact in the public areas with other users, such information may be viewed by all users and may be publicly distributed outside.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;With Your consent&lt;/strong&gt;: We may disclose Your personal information for any other purpose with Your consent.&lt;/li&gt;&lt;/ul&gt;&lt;h2&gt;Retention of Your Personal Data&lt;/h2&gt;&lt;p&gt;The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.&lt;/p&gt;&lt;p&gt;The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.&lt;/p&gt;&lt;h2&gt;Transfer of Your Personal Data&lt;/h2&gt;&lt;p&gt;Your information, including Personal Data, is processed at the Company&apos;s operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to &mdash; and maintained on &mdash; computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.&lt;/p&gt;&lt;p&gt;Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.&lt;/p&gt;&lt;p&gt;The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.&lt;/p&gt;&lt;h2&gt;Disclosure of Your Personal Data&lt;/h2&gt;&lt;h3&gt;Business Transactions&lt;/h3&gt;&lt;p&gt;If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.&lt;/p&gt;&lt;h3&gt;Law enforcement&lt;/h3&gt;&lt;p&gt;Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).&lt;/p&gt;&lt;h3&gt;Other legal requirements&lt;/h3&gt;&lt;p&gt;The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Comply with a legal obligation&lt;/li&gt;&lt;li&gt;Protect and defend the rights or property of the Company&lt;/li&gt;&lt;li&gt;Prevent or investigate possible wrongdoing in connection with the Service&lt;/li&gt;&lt;li&gt;Protect the personal safety of Users of the Service or the public&lt;/li&gt;&lt;li&gt;Protect against legal liability&lt;/li&gt;&lt;/ul&gt;&lt;h2&gt;Security of Your Personal Data&lt;/h2&gt;&lt;p&gt;The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.&lt;/p&gt;&lt;h1&gt;Detailed Information on the Processing of Your Personal Data&lt;/h1&gt;&lt;p&gt;The Service Providers We use may have access to Your Personal Data. These third-party vendors collect, store, use, process and transfer information about Your activity on Our Service in accordance with their Privacy Policies.&lt;/p&gt;&lt;h2&gt;Usage, Performance and Miscellaneous&lt;/h2&gt;&lt;p&gt;We may use third-party Service Providers to provide better improvement of our Service.&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;p&gt;&lt;strong&gt;Google Places&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Google Places is a service that returns information about places using HTTP requests. It is operated by Google&lt;/p&gt;&lt;p&gt;Google Places service may collect information from You and from Your Device for security purposes.&lt;/p&gt;&lt;p&gt;The information gathered by Google Places is held in accordance with the Privacy Policy of Google: &lt;a href=&quot;https://www.google.com/intl/en/policies/privacy/&quot; rel=&quot;external nofollow noopener&quot; target=&quot;_blank&quot;&gt;https://www.google.com/intl/en/policies/privacy/&lt;/a&gt;&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;h1&gt;Children&apos;s Privacy&lt;/h1&gt;&lt;p&gt;Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If You are a parent or guardian and You are aware that Your child has provided Us with Personal Data, please contact Us. If We become aware that We have collected Personal Data from anyone under the age of 13 without verification of parental consent, We take steps to remove that information from Our servers.&lt;/p&gt;&lt;p&gt;If We need to rely on consent as a legal basis for processing Your information and Your country requires consent from a parent, We may require Your parent&apos;s consent before We collect and use that information.&lt;/p&gt;&lt;h1&gt;Links to Other Websites&lt;/h1&gt;&lt;p&gt;Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party&apos;s site. We strongly advise You to review the Privacy Policy of every site You visit.&lt;/p&gt;&lt;p&gt;We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.&lt;/p&gt;&lt;h1&gt;Changes to this Privacy Policy&lt;/h1&gt;&lt;p&gt;We may update Our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.&lt;/p&gt;&lt;p&gt;We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the &quot;Last updated&quot; date at the top of this Privacy Policy.&lt;/p&gt;&lt;p&gt;You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.&lt;/p&gt;&lt;h1&gt;Contact Us&lt;/h1&gt;&lt;p&gt;If you have any questions about this Privacy Policy, You can contact us:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;By email: cs@retenvi.com&lt;/li&gt;&lt;/ul&gt;"),
            "post_author" => 1,
            "post_language" => 1,
            "post_type" => "page",
        ])->translations()->attach(45);

        # GALLERY

        Post::create([
            "id" => 66,
            "post_title" => "Picone",
            "post_name" => "picone",
            "post_content" => '<p>Image description</p>',
            "post_author" => 2,
            "post_language" => 1,
            "post_type" => "gallery",
            "post_guid" => "/storage/images/gallery.jpg",
            "post_image_meta" => "{\"file\":\"gallery.jpg\",\"type\":\"jpeg\",\"size\":614182,\"dimension\":\"1920x1080\",\"attr_image_alt\":\"another text\"}",
            "post_mime_type" => "image/jpeg",
            "post_status" => "inherit",
        ]);
    }
}
