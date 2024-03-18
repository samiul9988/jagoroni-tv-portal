@php
    $str = "&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;";
    echo htmlspecialchars_decode($str);
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($posts as $post)
        <url>
            <loc>{{ \App\Helpers\PostHelper::getUriPost($post) }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
