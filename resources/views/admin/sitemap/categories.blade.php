@php
    $str = "&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;";
    echo htmlspecialchars_decode($str);
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($categories as $category)
        <url>
            <loc>{{ $category->name }}</loc>
            <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>


