@php
$str = "&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;";
echo htmlspecialchars_decode($str);
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <sitemap>
        <loc>{{ route('sitemap.posts') }}</loc>
        <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.pages') }}</loc>
        <lastmod>{{ $page->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.categories') }}</loc>
        <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</urlset>
